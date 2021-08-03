<?php

namespace App\Http\Controllers;


use App\models\AdviserField;
use App\models\AdviserSpec;
use App\models\Master;
use App\models\PatientDates;
use App\models\StudentAdviser;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use PHPExcel_IOFactory;

class AdviserController extends Controller {

    public function createAdviserSpecs() {

        if(isset($_FILES["group"])) {

            $file = $_FILES["group"]["name"];

            if (!empty($file)) {

                $path = __DIR__ . '/../../../public/tmp/' . $file;

                $err = uploadCheck($path, "group", "اکسل تخصص مشاوران", 20000000, "xlsx");

                if (empty($err)) {
                    upload($path, "group", "اکسل تخصص مشاوران");
                    $excelReader = PHPExcel_IOFactory::createReaderForFile($path);
                    $excelObj = $excelReader->load($path);
                    $workSheet = $excelObj->getSheet(0);
                    $adviserFields = array();
                    $lastRow = $workSheet->getHighestRow();
                    $cols = $workSheet->getHighestColumn();

                    if ($cols < 'A') {
                        unlink($path);
                        $err = "تعداد ستون های فایل شما معتبر نمی باشد";
                    } else {
                        for ($row = 1; $row <= $lastRow; $row++) {

                            if ($workSheet->getCell('A' . $row)->getValue() == "")
                                break;

                            $adviserFields[$row - 1] = $workSheet->getCell('A' . $row)->getValue();
                        }

                        unlink($path);
                        $err = $this->addAdviserFieldOrSpec($adviserFields, 2);
                        if(empty($err))
                            $err = "تمام موارد به درستی به دیتابیس اضافه گردید";
                    }
                }
            }
            else
                $err = "لطفا فایل اکسل مورد نیاز را آپلود نمایید";
        }
        else
            $err = "لطفا فایل اکسل مورد نیاز را آپلود نمایید";

        return view('adviserField', ['err' => $err]);
    }

    public function addAdviserFieldOrSpec($arr, $mode) {

        $err = "";
        foreach ($arr as $itr) {

            if($mode == 1)
                $tmp = new AdviserField();
            else
                $tmp = new AdviserSpec();

            $tmp->name = $itr;
            try {
                $tmp->save();
            }
            catch (\Exception $x) {
                $err .= $itr . "<br/>";
            }
        }
        return $err;

    }

    public function adviserSpecs() {
        $adviserSpecs = AdviserSpec::all();
        return view('adviserField', ['items' => $adviserSpecs, 'editUrl' => route('editAdviserSpec'),
            'removeUrl' => route('removeAdviserSpec'), 'addItemUrl' => route('createAdviserSpecs'),
            'selfUrl' => route('adviserSpecs')]);
    }

    public function createAdviserFields() {

        if(isset($_FILES["group"])) {

            $file = $_FILES["group"]["name"];

            if (!empty($file)) {

                $path = __DIR__ . '/../../../public/tmp/' . $file;

                $err = uploadCheck($path, "group", "اکسل تخصص مشاوران", 20000000, "xlsx");

                if (empty($err)) {
                    upload($path, "group", "اکسل تخصص مشاوران");
                    $excelReader = PHPExcel_IOFactory::createReaderForFile($path);
                    $excelObj = $excelReader->load($path);
                    $workSheet = $excelObj->getSheet(0);
                    $adviserFields = array();
                    $lastRow = $workSheet->getHighestRow();
                    $cols = $workSheet->getHighestColumn();

                    if ($cols < 'A') {
                        unlink($path);
                        $err = "تعداد ستون های فایل شما معتبر نمی باشد";
                    } else {
                        for ($row = 1; $row <= $lastRow; $row++) {

                            if ($workSheet->getCell('A' . $row)->getValue() == "")
                                break;

                            $adviserFields[$row - 1] = $workSheet->getCell('A' . $row)->getValue();
                        }

                        unlink($path);
                        $err = $this->addAdviserFieldOrSpec($adviserFields, 1);
                        if(empty($err))
                            $err = "تمام موارد به درستی به دیتابیس اضافه گردید";
                    }
                }
            }
            else
                $err = "لطفا فایل اکسل مورد نیاز را آپلود نمایید";
        }
        else
            $err = "لطفا فایل اکسل مورد نیاز را آپلود نمایید";

        return view('adviserField', ['err' => $err]);
    }

    public function editAdviserField() {
        if(isset($_POST["itemId"]) && isset($_POST["name"])) {
            $adviserField = AdviserField::whereId(makeValidInput($_POST["itemId"]));
            if($adviserField != null) {
                $adviserField->name = makeValidInput($_POST["name"]);
                try {
                    $adviserField->save();
                    echo "ok";
                }
                catch (\Exception $x) {
                    echo "nok1";
                }
                return;
            }
            echo "nok2";
            return;
        }
        echo "nok3";
    }

    public function editAdviserSpec() {
        if(isset($_POST["itemId"]) && isset($_POST["name"])) {
            $adviserSpec = AdviserSpec::whereId(makeValidInput($_POST["itemId"]));
            if($adviserSpec != null) {
                $adviserSpec->name = makeValidInput($_POST["name"]);
                try {
                    $adviserSpec->save();
                    echo "ok";
                }
                catch (\Exception $x) {
                    echo "nok1";
                }
                return;
            }
            echo "nok2";
            return;
        }
        echo "nok3";
    }

    public function removeAdviserSpec() {
        if(isset($_POST["itemId"])) {
            try {
                AdviserSpec::destroy(makeValidInput($_POST["itemId"]));
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok1";
            }
            return;
        }
        echo "nok2";
    }

    public function removeAdviserField() {
        if(isset($_POST["itemId"])) {
            try {
                AdviserField::destroy(makeValidInput($_POST["itemId"]));
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok1";
            }
            return;
        }
        echo "nok2";
    }

    public function adviserFields() {
        $adviserFields = AdviserField::all();
        return view('adviserField', ['items' => $adviserFields, 'editUrl' => route('editAdviserField'),
            'removeUrl' => route('removeAdviserField'), 'addItemUrl' => route('createAdviserFields'), 'selfUrl' => route('adviserFields')]);
    }

    public function advisers() {

        $advisers = User::whereLevel(getValueInfo('adviserLevel'))->get();

        foreach ($advisers as $adviser) {
            $master = Master::whereUID($adviser->id)->first();
            if(!empty($master->pic))
                $adviser->pic = URL::asset('images/adviserPhoto/' . $master->pic);
        }

        return view('certifiers', ['users' => $advisers, 'url' => route('doAdviserRegister')]);

    }

    public function getAdvisers() {

        $advisers = User::whereLevel(getValueInfo('adviserLevel'))->get();

        foreach ($advisers as $adviser) {
            $adviser->additionalInfo = Master::whereUID($adviser->id)->first();
            switch ($adviser->additionalInfo->degreeLevel) {
                case getValueInfo('diplom'):
                    $tmp = "دیپلم";
                    break;
                case getValueInfo('foghDiplom'):
                    $tmp = "فوق دیپلم";
                    break;
                case getValueInfo('lisans'):
                    $tmp = "لیسانس";
                    break;
                case getValueInfo('foghLisans'):
                    $tmp = "فوق لیسانس";
                    break;
                case getValueInfo('doctor'):
                default:
                    $tmp = "دکترا";
                    break;
            }
            $adviser->additionalInfo->degreeLevel = $tmp;
            $adviser->additionalInfo->fieldId = AdviserField::whereId($adviser->additionalInfo->fieldId)->name;
            $adviser->additionalInfo->specId = AdviserSpec::whereId($adviser->additionalInfo->specId)->name;
        }

        echo json_encode($advisers);
    }

    public function adviserQueue() {

        $uId = Auth::user()->id;
        $students = StudentAdviser::whereAdviserId($uId)->whereStatus(false)->get();

        foreach ($students as $student) {
            $student->user = User::whereId($student->studentId);
        }
        return view('adviserQueue', ['students' => $students]);
    }

    public function rejectStudent() {

        if(isset($_POST["uId"])) {

            $userId = makeValidInput($_POST["uId"]);
            $uId = Auth::user()->id;

            $user = StudentAdviser::whereAdviserId($uId)->whereStudentId($userId)->first();
            if($user != null) {
                $user->delete();
                echo "ok";
            }
            else
                echo "nok1";
            return;
        }

        echo "nok2";
    }

    public function acceptStudent() {

        if(isset($_POST["uId"])) {

            $userId = makeValidInput($_POST["uId"]);
            $uId = Auth::user()->id;

            $user = StudentAdviser::whereAdviserId($uId)->whereStudentId($userId)->first();
            if($user != null) {
                $user->status = true;
                $user->save();
                echo "ok";
            }
            else
                echo "nok1";
            return;
        }

        echo "nok2";
    }

    public function setAsMyAdviser() {

        if(isset($_POST["adviserId"])) {

            $uId = Auth::user()->id;
            $adviserId = makeValidInput($_POST["adviserId"]);

            if(User::whereId($adviserId) == null) {
                echo "nok2";
                return;
            }

            $tmp = new StudentAdviser();
            $tmp->studentId = $uId;
            $tmp->adviserId = $adviserId;
            $tmp->status = false;

            try {
                $tmp->save();
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok3";
            }
            return;
        }

        echo "nok1";
    }

    public function getMyPatients() {

        $students = StudentAdviser::whereAdviserId(Auth::user()->id)->whereStatus(true)->get();

        $users = [];
        $counter = 0;

        foreach ($students as $student) {
            $tmp = User::whereId($student->studentId);
            $tmp->studentAdviserId = $student->id;
            $users[$counter++] = $tmp;
        }

        echo json_encode($users);
    }

    public function getPatientDates() {

        if(isset($_POST["studentId"])) {
            $studentId = makeValidInput($_POST["studentId"]);
            $tmp = StudentAdviser::whereAdviserId(Auth::user()->id)->whereStudentId($studentId)->first();
            if($tmp != null) {
                $dates = PatientDates::whereStudentAdviserId($tmp->id)->select('date')->get();
                $out = [];
                $counter = 0;
                foreach ($dates as $date) {
                    $out[$counter++] = convertStringToDate($date->date);
                }
                echo json_encode(["status" => "ok", "dates" => $out]);
            }
            else
                echo json_encode(['status' => 'nok1']);
            return;
        }
        echo json_encode(['status' => 'nok2']);
    }

    public function addDateToPatient() {

        if(isset($_POST["studentAdviserId"]) && isset($_POST["date"])) {

            $studentAdviserId = makeValidInput($_POST["studentAdviserId"]);
            $tmp = StudentAdviser::whereId($studentAdviserId);
            if($tmp != null && $tmp->adviserId == Auth::user()->id) {
                $patientDate = new PatientDates();
                $patientDate->date = convertDateToString(makeValidInput($_POST["date"]));
                $patientDate->studentAdviserId = $studentAdviserId;
                try {
                    $patientDate->save();
                    echo "ok";
                }
                catch (\Exception $x) {
                    echo "nok1";
                }
                return;
            }
            echo "nok2";
            return;
        }
        echo "nok3";
    }

    public function deletePatientDate() {

        if(isset($_POST["patientDateId"])) {
            $patientDate = PatientDates::whereId(makeValidInput($_POST["patientDateId"]));
            if($patientDate != null) {
                $tmp = StudentAdviser::whereId($patientDate->studentAdviserId);
                if($tmp != null && $tmp->adviserId == Auth::user()->id) {
                    try {
                        $patientDate->delete();
                        echo "ok";
                    }
                    catch (\Exception $x) {
                        echo "nok1";
                    }
                    return;
                }
                echo "nok2";
                return;
            }
            echo "nok3";
            return;
        }

        echo "nok4";
    }

    public function myDates() {

        $studentAdviser = StudentAdviser::whereStudentId(Auth::user()->id)->first();
        if($studentAdviser != null) {
            $dates = PatientDates::whereStudentAdviserId($studentAdviser->id)->select('date')->get();

            $out = [];
            $counter = 0;

            foreach ($dates as $date)
                $out[$counter++] = convertStringToDate($date->date);

            echo json_encode($out);
            return;
        }
        echo json_encode([]);
    }

    public function setAdviserPic() {

        if(isset($_FILES["pic"]) && isset($_POST["uId"])) {

            $master = Master::whereUID(makeValidInput($_POST["uId"]))->first();

            if(isset($_FILES["pic"])) {

                $file = $_FILES["pic"]["name"];

                if (!empty($file)) {

                    $path = __DIR__ . '/../../../public/images/adviserPhoto/' . $file;

                    $err = uploadCheck($path, "pic", "تصویر مشاوران", 20000000, "jpg");

                    if (empty($err)) {
                        upload($path, "pic", "تصویر مشاوران");
                        $master->pic = $file;
                        try {
                            $master->save();
                        }
                        catch (\Exception $x) {
                            unlink($path);
                        }
                    }
                }
            }
        }

        return Redirect::route('advisers');

    }
}
