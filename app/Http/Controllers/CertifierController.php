<?php

namespace App\Http\Controllers;

use App\models\AdditionalInfo;
use App\models\Certificate;
use App\models\Event;
use App\models\EventDay;
use App\models\EventRegistry;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CertifierController extends Controller {

    public function certifier() {

        $certifiers = User::whereLevel(getValueInfo('certificateLevel'))->get();

        return view('certifiers', ['users' => $certifiers, 'url' => route('doCertifierRegister')]);

    }

    public function certificates($eventId) {

        $registries = EventRegistry::whereEventId($eventId)->get();
        foreach ($registries as $registry) {
            $user = User::whereId($registry->uId);
            $registry->user = $user->firstName . " " . $user->lastName;
            $cer = Certificate::whereEventId($eventId)->whereUId($registry->uId)->first();
            if($cer != null) {
                $registry->publish = true;
                $registry->certificateId = $cer->id;
            }
            else
                $registry->publish = false;
        }


        return view('certificates', ['registries' => $registries, 'eventId' => $eventId]);
    }

    public function removeCertificate() {

        if(isset($_POST["certificateId"])) {

            try {
                Certificate::destroy(makeValidInput($_POST["certificateId"]));
                echo "ok";
                return;
            }
            catch (\Exception $x) {}
        }

        echo "nok";

    }

    public function publishCertificate($eventId, $uId) {

        $user = User::whereId($uId);
        if($user == null)
            return Redirect::route('profile');

        $event = Event::whereId($eventId);
        if($event == null)
            return Redirect::route('profile');

        $additionalInfo = AdditionalInfo::whereUID($uId)->first();
        if($additionalInfo == null)
            return Redirect::route('profile');

        $eventDayCount = EventDay::whereEventId($eventId)->count();
        if($eventDayCount == 0)
            return Redirect::route('profile');

        $user->event = $event;
        $user->additionalInfo = $additionalInfo;
        $cer = Certificate::whereEventId($eventId)->whereUId($uId)->first();
        if($cer != null) {
            $user->cerCode = $cer->code;
            $user->publishDate = convertStringToDate($cer->publishDate);
        }
        else {
            $user->cerCode = "";
            $user->publishDate = convertStringToDate(getToday()["date"]);
        }

        $user->startDate = convertStringToDate(EventDay::whereEventId($eventId)->orderBy('date', 'ASC')->first()->date);
        $user->endDate = convertStringToDate(EventDay::whereEventId($eventId)->orderBy('date', 'DESC')->first()->date);
        $user->eventLength = $event->duration * $eventDayCount;


        return view('publishCertificate', ['user' => $user, 'eventId' => $eventId]);

    }

    public function doPublishCertificate($eventId, $uId) {

        if (isset($_POST["cerCode"]) && isset($_POST["publishDate"])) {

            $certificate = Certificate::whereEventId($eventId)->whereUId($uId)->first();

            if($certificate == null) {
                $certificate = new Certificate();
                $certificate->eventId = $eventId;
                $certificate->uId = $uId;
            }

            $certificate->code = makeValidInput($_POST["cerCode"]);
            $certificate->publishDate = convertDateToString(makeValidInput($_POST["publishDate"]));

            try {
                $certificate->save();
            }
            catch (\Exception $x) {
                dd($x->getMessage());
            }
        }

        return Redirect::route('certificates', ['eventId' => $eventId]);

    }

    public function getMyCertificate() {

        if(isset($_POST["eventId"])) {

            $eventId = makeValidInput($_POST["eventId"]);
            $event = Event::whereId($eventId);
            if($event == null) {
                echo json_encode(["status" => "nok1"]);
                return;
            }

            $user = Auth::user();

            $additionalInfo = AdditionalInfo::whereUID($user->id)->first();
            if($additionalInfo == null) {
                echo json_encode(["status" => "nok3"]);
                return;
            }

            $eventDayCount = EventDay::whereEventId($eventId)->count();
            if($eventDayCount == 0) {
                echo json_encode(["status" => "nok4"]);
                return;
            }

            $certificate = Certificate::whereEventId($eventId)->whereUId($user->id)->first();
            if($certificate == null) {
                echo json_encode(["status" => "nok2"]);
                return;
            }

            $certificate->publishDate = convertStringToDate($certificate->publishDate);
            $certificate->name = $user->firstName . " " . $user->lastName;
            $certificate->eventName = $event->name;
            $certificate->launcher = $event->launcher;
            $certificate->fatherName = $additionalInfo->fatherName;
            $certificate->NID = $additionalInfo->NID;

            $certificate->startDate = convertStringToDate(EventDay::whereEventId($eventId)->orderBy('date', 'ASC')->first()->date);
            $certificate->endDate = convertStringToDate(EventDay::whereEventId($eventId)->orderBy('date', 'DESC')->first()->date);
            $certificate->eventLength = $event->duration * $eventDayCount;

            echo json_encode(['status' => 'ok', 'certificate' => $certificate]);
            return;
        }

        echo json_encode(["status" => "nok5"]);
        return;
    }

}
