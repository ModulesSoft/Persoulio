<?php

namespace App\Http\Controllers;

use App\models\Bio;
use App\models\ConfigModel;
use App\models\EntryYear;
use App\models\Event;
use App\models\Factor;
use App\models\Field;
use App\models\Like;
use App\models\MessageBox;
use App\models\NotifSentence;
use App\models\Offer;
use App\models\Quiz;
use App\models\TagModel;
use App\models\Tip;
use App\models\User;
use App\models\UserPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use PHPExcel_IOFactory;

class AdminController extends Controller {

    public function manageFriendAvailability() {
        return view('config', array('config' => ConfigModel::first(), 'quizStatus' => Quiz::whereId(1)->status));
    }

    public function changeExchangeRate() {
        if (isset($_POST["val"])) {
            $config = ConfigModel::first();
            $config->exchangeRate = makeValidInput($_POST["val"]);
            $config->save();
        }
    }

    public function setFriendAvailibility(){
        if (isset($_POST["status"])) {

            $config = ConfigModel::first();
            $config->friendAvailibility = makeValidInput($_POST["status"]);
            $config->save();
        }
    }

    public function setQuizStatus()
    {

        if (isset($_POST["status"])) {

            $quiz = Quiz::whereId(1);
            $quiz->status = makeValidInput($_POST["status"]);
            $quiz->save();

        }
    }

    public function manageLikes($err = "") {

        $user = Auth::user();

        $bio = Bio::whereUId($user->id)->first();

        if ($bio == null)
            $bio = "";
        else
            $bio = $bio->description;

        $tips = DB::select('select tip.name from tip, userTip WHERE tip.id = tipId and uId = ' . $user->id);

        $userPhoto = UserPhoto::whereUId($user->id)->first();
        if ($userPhoto == null)
            $user->photo = URL::asset('images/profile.png');
        else
            $user->photo = URL::asset('images/userPhotos/' . $userPhoto->photo);

        return view('likeManager', array('user' => $user, 'tips' => $tips, 'bio' => $bio, 'err' => $err,
            'likes' => Like::all()));

    }

    public function addLike() {

        if (isset($_POST["likeName"])) {

            $like = new Like();
            $like->name = makeValidInput($_POST["likeName"]);

            try {
                $like->save();
                return Redirect::route('manageLikes');
            } catch (\Exception $x) {}
        }

        return $this->manageLikes('خطایی در انجام عملیات مورد نظر رخ داده است');

    }

    public function deleteLike() {

        if (isset($_POST["id"])) {

            try {
                Like::destroy(makeValidInput($_POST["id"]));
                echo "ok";
                return;
            } catch (\Exception $x) {
            }
        }

        echo "nok";

    }

    public function editLike() {

        if (isset($_POST["id"]) && isset($_POST["name"])) {

            $like = Like::whereId(makeValidInput($_POST["id"]));

            if ($like == null)
                return "nok";

            $like->name = makeValidInput($_POST["name"]);

            try {
                $like->save();
                return "ok";
            } catch (\Exception $x) {}
        }

        return "nok";
    }

//    yousef
    public function giveMeHashedPassword()
    {
//        $users = DB::select('select DISTINCT(uId) as id from ROQ');
//        UserTip::delete();
//
//        foreach ($users as $user) {
//
//            $uId = $user->id;
//
//            $marks = DB::select('select sum(mark) as sumMark, factorId from ROQ, QOQ, neoFactor WHERE
//      ROQ.uId = ' . $uId . ' and QOQ.id = ROQ.qoqId and QOQ.questionId = neoFactor.qId and
//      ROQ.result = neoFactor.ansId group by(factorId)');
//
//            $tips = Tip::all();
//            $myTips = [];
//
//            foreach ($tips as $tip) {
//                $allow = true;
//
//                foreach ($marks as $mark) {
//                    $condition = ['tipId' => $tip->id, 'factorId' => $mark->factorId];
//                    $constraint = TipConstraint::where($condition)->first();
//                    if ($constraint == null || count($constraint) == 0)
//                        continue;
//
//                    if ($constraint->floor > $mark->sumMark || $constraint->ceil < $mark->sumMark) {
//                        $allow = false;
//                        break;
//                    }
//                }
//
//                if ($allow) {
//                    $myTips[count($myTips)] = $tip->id;
//                }
//            }
//
//            foreach ($myTips as $myTip) {
//                $userTip = new UserTip();
//                $userTip->uId = $uId;
//                $userTip->tipId = $myTip;
//                $userTip->save();
//            }
//        }
//      give me hashed code

        $shomare =$_GET['shomare'];
        $id = DB::select('select id ,lastname from users where phonenum='.$shomare);
        $uid = $id[0]->id;
        $marks = DB::select('select sum(mark) as sumMark, factor.name, factor.id from ROQ, QOQ, neoFactor, factor WHERE factorId = factor.id and
			ROQ.uId = '.$uid.' and QOQ.id = ROQ.qoqId and QOQ.questionId = neoFactor.qId and
			ROQ.result = neoFactor.ansId group by(factorId)');

        echo "lastname: ".$id[0]->lastname." phone number= ".$shomare." with id= ".$uid.":<br>";
        for ($i=0 ; $i<5 ; $i++)
            echo($marks[$i]->name . ":" . $marks[$i]->sumMark ."<br>");
        echo "<br>";
        die( Hash::make("12345"));
//        die("---");
    }


    //secondPhase

    public function manageTags() {

        $user = Auth::user();

        $bio = Bio::whereUId($user->id)->first();

        if ($bio == null)
            $bio = "";
        else
            $bio = $bio->description;

        $tips = DB::select('select tip.name from tip, userTip WHERE tip.id = tipId and uId = ' . $user->id);

        $userPhoto = UserPhoto::whereUId($user->id)->first();
        if ($userPhoto == null)
            $user->photo = URL::asset('images/profile.png');
        else
            $user->photo = URL::asset('images/userPhotos/' . $userPhoto->photo);


        return view('manageTags', array('user' => $user, 'tips' => $tips, 'bio' => $bio, 'AllTips' => Tip::orderBy('id', 'ASC')->get(), 'likes' => Like::all()));

    }

    public function getTags() {

        if(isset($_POST["mode"]))
            $tags = TagModel::whereMode(makeValidInput($_POST["mode"]))->get();
        else
            $tags = TagModel::all();

        foreach ($tags as $tag) {
            switch ($tag->mode) {
                case getValueInfo("mag"):
                    $tag->mode = "مگ";
                    break;
                case getValueInfo('fun'):
                    $tag->mode = "فان";
                    break;
                case getValueInfo('tunnel'):
                    $tag->mode = "تونل";
                    break;
            }
        }

        echo json_encode($tags);
    }

    public function addTag() {

        if(isset($_POST["name"]) && isset($_POST["mode"]) && isset($_POST["general"])) {

            $tag = new TagModel();
            $tag->name = makeValidInput($_POST["name"]);
            $tag->mode = makeValidInput($_POST["mode"]);
            $tag->general = (makeValidInput($_POST["general"]) == "true");
            try {
                $tag->save();
                echo "ok";
            }
            catch (\Exception $x) {
                echo $x->getMessage();
            }
        }
    }

    public function deleteTag() {

        if(isset($_POST["id"])) {
            try {
                TagModel::destroy(makeValidInput($_POST["id"]));
                echo "ok";
            }
            catch (\Exception $x) {}
        }
    }

    public function editTag() {

        if(isset($_POST["id"]) && isset($_POST["text"])) {
            try {
                $tmp = TagModel::whereId(makeValidInput($_POST["id"]));
                if($tmp != null) {
                    $tmp->name = makeValidInput($_POST["text"]);
                    try {
                        $tmp->save();
                        echo "ok";
                    }
                    catch (\Exception $x) {}
                }
            }
            catch (\Exception $x) {}
        }
    }

    public function toggleUserStatus() {
        
        if(isset($_POST["uId"])) {
            $user = User::whereId(makeValidInput($_POST["uId"]));

            if($user != null && $user->level != getValueInfo('adminLevel')) {
                $user->status = ($user->status) ? false : true;
                try {
                    $user->save();
                    echo "ok";
                }
                catch (\Exception $x) {
                    echo "nok3";
                }
                return;
            }

            echo "nok1";
            return;
        }
        echo "nok2";
    }

    public function factors() {
        return view('factor', ['factors' => Factor::all()]);
    }

    public function addFactor() {
        if(isset($_POST["name"])) {
            $factor = new Factor();
            $factor->name = makeValidInput($_POST["name"]);
            try {
                $factor->save();
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok1";
            }
            return;
        }
        echo "nok2";
    }

    public function deleteFactor() {
        if(isset($_POST["factorId"])) {
            try {
                Factor::destroy(makeValidInput($_POST["factorId"]));
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok1";
            }
            return;
        }
        echo "nok2";
    }

    public function editFactor() {
        if(isset($_POST["factorId"]) && isset($_POST["name"])) {

            $factor = Factor::whereId(makeValidInput($_POST["factorId"]));

            if($factor != null) {
                $factor->name = makeValidInput($_POST["name"]);
                try {
                    $factor->save();
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

    public function createOffer() {
        return view('createOffer', ['entryYears' => EntryYear::all(), 'fields' => Field::all()]);
    }

    public function doCreateOffer() {

        if(isset($_POST["amount"]) && isset($_POST["offerKind"]) && isset($_POST["query"]) && isset($_POST["expireTime"])) {

            $query = $_POST["query"];
            $amount = makeValidInput($_POST["amount"]);
            $offerKind = makeValidInput($_POST["offerKind"]);
            $expireTime = makeValidInput($_POST["expireTime"]);

            try {
                $users = DB::select($query);
                $sdate = getToday()["date"];
                foreach ($users as $user) {
                    $offer = new Offer();
                    $offer->offerKind = ($offerKind == getValueInfo('staticOffer'));
                    $offer->amount = $amount;
                    $offer->uId = $user->id;
                    $code = 'p' . random_int(100000, 999999);
                    while (Offer::whereCode($code)->count() > 0)
                        $code = 'p' . random_int(100000, 999999);
                    $offer->code = $code;
                    if($expireTime != "none")
                        $offer->expireTime = $expireTime;
                    else
                        $offer->expireTime = null;

                    try {
                        $offer->save();

                        $message = new MessageBox();
                        $message->message = "کاربر گرامی، کد تخفیف " . $code . ' به ارزش' . $amount .
                            (($offerKind == getValueInfo('staticOffer')) ? (' تومانی') : (' درصدی')) .
                            (($expireTime != "none") ? ("تا تاریخ " . $expireTime) : '') .
                            'به شما تعلق گرفته است';
                        $message->uId = $user->id;
                        $message->sdate = $sdate;
                        $message->save();
                        
                        sendSMS($user->phoneNum, $code, "offCode", $amount, ($offerKind == getValueInfo('staticOffer')) ? 'تومان' : 'درصد');

                    }
                    catch (\Exception $x) {}
                }
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok";
            }
        }
    }

    public function createOfferOnEvent() {
        return view('createOfferOnEvent');
    }

    public function doCreateOfferOnEvent() {

        if(isset($_POST["amount"]) && isset($_POST["eventId"]) && isset($_POST["isQuiz"])) {

            if(makeValidInput($_POST["isQuiz"]) == "true") {

                $quiz = Quiz::whereId(makeValidInput($_POST["eventId"]));
                if($quiz != null) {
                    $quiz->off = makeValidInput($_POST["amount"]);
                    $quiz->save();
                    echo "ok";
                    return;
                }
            }
            else {
                $event = Event::whereId(makeValidInput($_POST['eventId']));
                if($event != null) {
                    $event->off = makeValidInput($_POST["amount"]);
                    $event->save();
                    echo "ok";
                    return;
                }
            }
        }
        echo "nok";
    }
}
