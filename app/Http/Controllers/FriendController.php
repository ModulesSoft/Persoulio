<?php

namespace App\Http\Controllers;

use App\models\Bio;
use App\models\Block;
use App\models\Field;
use App\models\Follower;
use App\models\GeneralShowMe;
use App\models\Instagram;
use App\models\QEntry;
use App\models\Quiz;
use App\models\RequestModel;
use App\models\State;
use App\models\Telegram;
use App\models\User;
use App\models\UserPhoto;
use App\models\UserState;
use App\models\UserTip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class FriendController extends Controller {

    private function checkInvitationConstraints($uId) {

        $showMe = GeneralShowMe::whereUId($uId)->first();

        if($showMe == null) {
            $showMe = new GeneralShowMe();
            $showMe->phoneNum = 0;
            $showMe->telegramId = 0;
            $showMe->instagramId = 0;
            $showMe->uId = $uId;
            try {
                $showMe->save();
            }
            catch (\Exception $x) {
                return -2;
            }
        }

        if($showMe->phoneNum == 0 && $showMe->telegramId == 0 && $showMe->instagramId == 0)
            return -1;

        if(Bio::whereUId($uId)->count() == 0)
            return -2;

        $state = UserState::whereUId($uId)->first();
        if($state == null || State::whereId($state->stateId) == null)
            return -3;

        return 1;
    }

    public function inviteFriend() {

        $quiz = Quiz::whereId(1);
        if($quiz == null || $quiz->status == 0)
            return view('waitForResult');

        $user = Auth::user();

        $qEntry = QEntry::whereUId($user->id)->whereQId($quiz->id)->first();

        if($qEntry == null || $qEntry->status == 0)
            return Redirect::route("preQuiz", ['quizId' => Quiz::first()->id]);

        $result = $this->checkInvitationConstraints($user->id);

        $bio = Bio::whereUId($user->id)->first();

        if($bio == null)
            $bio = "";
        else
            $bio = $bio->description;

        $tips = DB::select('select tip.name from tip, userTip WHERE tip.id = tipId and uId = ' . $user->id);

        $userPhoto = UserPhoto::whereUId($user->id)->first();
        if($userPhoto == null)
            $user->photo = URL::asset('images/profile.png');
        else
            $user->photo = URL::asset('images/userPhotos/' . $userPhoto->photo);

        if($result == -1)
            return view('inviteFriend', array('err' => 'لطفا قابل نمایشت رو درست کن', 'user' => $user, 'bio' => $bio, 'tips' => $tips));
        if($result == -2)
            return view('inviteFriend', array('err' => 'لطفا یه بیو بزار', 'user' => $user, 'bio' => $bio, 'tips' => $tips));
        if($result == -3)
            return view('inviteFriend', array('err' => 'لطفا شهرت رو انتخاب کن', 'user' => $user, 'bio' => $bio, 'tips' => $tips));


        return view('inviteFriend', array('user' => $user, 'bio' => $bio, 'tips' => $tips));
    }

    public function findMySuggestionsWithConstraint() {

        if(isset($_POST{"fieldSort"}) && isset($_POST["stateSort"])) {

            $user = Auth::user();

            $fieldSort = -1;
            if (makeValidInput($_POST["fieldSort"]) != -1)
                $fieldSort = $user->fieldId;

            $stateSort = -1;
            if (makeValidInput($_POST["stateSort"]) != -1)
                $stateSort = UserState::whereUId($user->id)->first()->stateId;

            $uIds = $this->findMySuggestions($stateSort, $fieldSort);

            $out = [];
            $counter = 0;

            foreach ($uIds as $uId) {

                if ($this->checkInvitationConstraints($uId->uId) != 1)
                    continue;

                $tmp = User::whereId($uId->uId);
                $out[$counter]['uId'] = $uId->uId;
                $out[$counter]['firstName'] = $tmp->firstName;
                $out[$counter]['lastName'] = $tmp->lastName;
                $bioTmp = Bio::whereUId($uId->uId)->first();
                if ($bioTmp == null)
                    $bioTmp = "";
                else
                    $bioTmp = $bioTmp->description;
                $out[$counter]['bio'] = $bioTmp;

                $photoTmp = UserPhoto::whereUId($uId->uId)->first();
                if ($photoTmp == null)
                    $photoTmp = URL::asset('images/profile.png');
                else
                    $photoTmp = URL::asset('images/userPhotos/' . $photoTmp->photo);

                $out[$counter]['photo'] = $photoTmp;
                $out[$counter]['field'] = Field::whereId($tmp->fieldId)->name;
                $out[$counter]["state"] = State::whereId(UserState::whereUId($uId->uId)->first()->stateId)->name;
                $counter++;
            }

            echo json_encode($out);
        }
    }

    public function acceptRequest() {

        if(isset($_POST["uId"])) {

            $srcId = makeValidInput($_POST["uId"]);
            $uId = Auth::user()->id;

            $request = RequestModel::whereSrcId($srcId)->whereDestId($uId)->first();

            if($request != null) {
                $follower = new Follower();
                $follower->srcId = $srcId;
                $follower->destId = $uId;
                $follower->mode = $request->mode;

                try {
                    $follower->save();
                    $request->delete();
                    echo "ok";
                    return;
                }
                catch (\Exception $x) {}
            }
        }

        echo "nok";
    }

    public function rejectRequest() {
        if(isset($_POST["uId"])) {

            $srcId = makeValidInput($_POST["uId"]);
            $uId = Auth::user()->id;

            $request = RequestModel::whereSrcId($srcId)->whereDestId($uId)->first();

            if($request != null) {

                $block = new Block();
                $block->srcId = $uId;
                $block->destId = $srcId;

                try {
                    $block->save();
                    $request->delete();
                    echo "ok";
                    return;
                }
                catch (\Exception $x) {}
            }
        }

        echo "nok";
    }

    public function getBlocks() {

        $uId = Auth::user()->id;

        $uIds = Block::whereSrcId($uId)->get();

        foreach ($uIds as $uId) {
            $tmp = UserPhoto::whereUId($uId->destId)->first();
            if($tmp == null)
                $tmp = URL::asset('images/profile.png');
            else
                $tmp = URL::asset('images/userPhotos/' . $tmp->photo);

            $uId->photo = $tmp;
            $user = User::whereId($uId->destId);
            $uId->firstName = $user->firstName;
            $uId->lastName = $user->lastName;
            $uId->bio = Bio::whereUId($uId->destId)->first()->description;
            $uId->state = State::whereId(UserState::whereUId($uId->destId)->first()->stateId)->name;
            $uId->field = Field::whereId($user->fieldId)->name;
        }

        echo json_encode($uIds);

    }

    public function unBlock() {

        if(isset($_POST["destId"])) {

            $destId = makeValidInput($_POST["destId"]);
            $srcId = Auth::user()->id;

            $block = Block::whereSrcId($srcId)->whereDestId($destId)->first();

            if($block != null) {
                $block->delete();
                echo "ok";
                return;
            }
        }
        echo "nok";
    }

    public function getAccepted() {

        $uId = Auth::user()->id;
        if(isset($_POST["mode"]))
            $uIds = Follower::whereMode(makeValidInput($_POST["mode"]))->whereDestId($uId)->orWhere('srcId', '=', $uId)->get();
        else
            $uIds = Follower::whereDestId($uId)->orWhere('srcId', '=', $uId)->get();

        foreach ($uIds as $itr) {

            $tmpUId = ($itr->srcId == $uId) ? $itr->destId : $itr->srcId;

            $tmp = UserPhoto::whereUId($tmpUId)->first();
            if($tmp == null)
                $tmp = URL::asset('images/profile.png');
            else
                $tmp = URL::asset('images/userPhotos/' . $tmp->photo);

            $itr->photo = $tmp;
            $user = User::whereId($tmpUId);
            $itr->firstName = $user->firstName;
            $itr->lastName = $user->lastName;
            $tmpBio = Bio::whereUId($tmpUId)->first();
            if($tmpBio != null)
                $itr->bio = $tmpBio->description;
            else
                $itr->bio = "";

            $tmpState = UserState::whereUId($tmpUId)->first();
            if($tmpState != null)
                $itr->state = State::whereId($tmpState->stateId)->name;
            else
                $itr->state = "نا مشخص";

            $itr->field = Field::whereId($user->fieldId)->name;
            switch ($itr->mode) {
                case getValueInfo('rafigh'):
                    $itr->mode = "رفیق";
                    break;
                case getValueInfo('dost'):
                    $itr->mode = "دوست";
                    break;
                case getValueInfo('ashna'):
                default:
                    $itr->mode = "آشنا";
                    break;
            }
            $tmpShowMe = GeneralShowMe::whereUId($tmpUId)->first();
            $itr->showMe = "";
            if($tmpShowMe->phoneNum == 1)
                $itr->showMe .= 'شماره همراه: ' . $user->phoneNum . '<br/>';

            if($tmpShowMe->telegramId == 1)
                $itr->showMe .= 'نام کاربری تلگرام: ' . Telegram::whereUId($tmpUId)->first()->telegramUserName . '<br/>';

            if($tmpShowMe->instagramId == 1)
                $itr->showMe .= 'نام کاربری اینستاگرام: ' . Instagram::whereUId($tmpUId)->first()->instagramUserName . '<br/>';

            $itr->targetId = $tmpUId;
        }

        echo json_encode($uIds);
    }

    private function findMySuggestions($stateId, $fieldId) {

        $uId = Auth::user()->id;
        $myTip = UserTip::whereUId($uId)->first();

        if($myTip == null)
            return null;
        $myTip = $myTip->tipId;

        if($stateId != -1) {
            if($fieldId != -1) {
                return DB::select("select userTip.uId from userTip, userState, users WHERE userTip.uId = userState.uId and" .
                    " userState.uId = users.id and users.fieldId = " . $stateId . " and userTip.uId <> " . $uId . " and".
                    " tipId = " . $myTip . " and userState.stateId = " . $stateId .
                    " and not exists(select * from follower where (srcId = userTip.uId and destId = " . $uId . ")".
                    " or (srcId = " . $uId . " and destId = userTip.uId))" .
                    " and not exists(select * from block where destId = userTip.uId and srcId = " . $uId . ")" .
                    " and not exists(select * from request where (destId = userTip.uId and srcId = " . $uId . ")" .
                    " or (destId = " . $uId . " and srcId = userTip.uId))"
                );
            }
            else {
                return DB::select("select userTip.uId from userTip, userState WHERE userTip.uId = userState.uId and " .
                    "userState.stateId = " . $stateId . " and userState.uId <> " . $uId . " and tipId = " . $myTip .
                    " and not exists(select * from follower where (srcId = userTip.uId and destId = " . $uId . ")".
                    " or (srcId = " . $uId . " and destId = userTip.uId))" .
                    " and not exists(select * from block where destId = userTip.uId and srcId = " . $uId . ")" .
                    " and not exists(select * from request where (destId = userTip.uId and srcId = " . $uId . ")" .
                    " or (destId = " . $uId . " and srcId = userTip.uId))"
                );
            }
        }
        else {
            if($fieldId != -1) {
                return DB::select("select uId from userTip, users WHERE users.id = userTip.uId and" .
                    " users.fieldId = " . $fieldId . " and uId <> " . $uId . " and tipId = " . $myTip .
                    " and not exists(select * from follower where (srcId = uId and destId = " . $uId . ")".
                    " or (srcId = " . $uId . " and destId = uId))" .
                    " and not exists(select * from block where destId = userTip.uId and srcId = " . $uId . ")" .
                    " and not exists(select * from request where (destId = userTip.uId and srcId = " . $uId . ")" .
                    " or (destId = " . $uId . " and srcId = userTip.uId))"
                );
            }
            else {
                return DB::select("select uId from userTip WHERE uId <> " . $uId . " and tipId = " . $myTip .
                    " and not exists(select * from follower where (srcId = uId and destId = " . $uId . ")".
                    " or (srcId = " . $uId . " and destId = uId))" .
                    " and not exists(select * from block where destId = userTip.uId and srcId = " . $uId . ")" .
                    " and not exists(select * from request where (destId = userTip.uId and srcId = " . $uId . ")" .
                    " or (destId = " . $uId . " and srcId = userTip.uId))"
                );
            }
        }

    }

    public function submitRequest() {

        if(isset($_POST["uId"]) && isset($_POST["mode"])) {

            $uId = makeValidInput($_POST["uId"]);
            $srcId = Auth::user()->id;

            $destTip = UserTip::whereUId($uId)->first()->tipId;
            $srcTip = UserTip::whereUId($srcId)->first()->tipId;

            if($destTip == $srcTip) {

                if(Block::whereSrcId($uId)->whereDestId($srcId)->count() == 0) {

                    if(Block::whereDestId($uId)->whereSrcId($srcId)->count() == 0) {

                        $follower = new RequestModel();
                        $follower->srcId = $srcId;
                        $follower->destId = $uId;
                        $follower->mode = makeValidInput($_POST["mode"]);

                        try {
                            $follower->save();
                            echo "ok";
                            return;
                        }
                        catch (\Exception $x) {}
                    }
                }
            }
        }

        echo "nok";
    }

    public function reject() {

        if(isset($_POST["uId"])) {

            $uId = makeValidInput($_POST["uId"]);
            $srcId = Auth::user()->id;

            $destTip = UserTip::whereUId($uId)->first()->tipId;
            $srcTip = UserTip::whereUId($srcId)->first()->tipId;

            if($destTip == $srcTip) {

                if(Block::whereSrcId($srcId)->whereDestId($uId)->count() == 0) {

                    Follower::whereSrcId($srcId)->whereDestId($uId)->delete();

                    Follower::whereSrcId($srcId)->whereDestId($srcId)->delete();

                    $block = new Block();
                    $block->srcId = $srcId;
                    $block->destId = $uId;
                    try {
                        $block->save();
                        echo "ok";
                        return;
                    }
                    catch (\Exception $x) {}
                }
                else {
                    echo "ok";
                    return;
                }
            }
        }

        echo "nok";
    }

    public function manageFriends() {
        return view('manageFriends');
    }

    public function getMyRequestsStatus() {

        $uId = Auth::user()->id;

        if(isset($_POST["mode"]))
            $uIds = RequestModel::whereMode(makeValidInput($_POST["mode"]))->whereSrcId($uId)->select('destId')->get();
        else
            $uIds = RequestModel::whereSrcId($uId)->select('destId')->get();

        foreach ($uIds as $uId) {
            $tmp = UserPhoto::whereUId($uId->destId)->first();
            if($tmp == null)
                $tmp = URL::asset('images/profile.png');
            else
                $tmp = URL::asset('images/userPhotos/' . $tmp->photo);

            $uId->photo = $tmp;
            $user = User::whereId($uId->destId);
            $uId->firstName = $user->firstName;
            $uId->lastName = $user->lastName;
            $uId->bio = Bio::whereUId($uId->destId)->first()->description;
            $uId->state = State::whereId(UserState::whereUId($uId->destId)->first()->stateId)->name;
            $uId->field = Field::whereId($user->fieldId)->name;
            switch ($uId->mode) {
                case getValueInfo('rafigh'):
                    $uId->mode = "رفیق";
                    break;
                case getValueInfo('dost'):
                    $uId->mode = "دوست";
                    break;
                case getValueInfo('ashna'):
                default:
                    $uId->mode = "آشنا";
                    break;
            }
        }

        echo json_encode($uIds);

    }

    public function cancelRequest() {

        if(isset($_POST["destId"])) {

            $destId = makeValidInput($_POST["destId"]);
            $uId = Auth::user()->id;

            $request = RequestModel::whereSrcId($uId)->whereDestId($destId)->first();

            if($request != null) {
                $request->delete();
                echo "ok";
                return;
            }
        }
        echo "nok";
    }

    public function getRequests() {
        
        $uId = Auth::user()->id;
        if(isset($_POST["mode"]))
            $uIds = RequestModel::whereMode(makeValidInput($_POST["mode"]))->whereDestId($uId)->get();
        else
            $uIds = RequestModel::whereDestId($uId)->get();

        foreach ($uIds as $uId) {
            $tmp = UserPhoto::whereUId($uId->srcId)->first();
            if($tmp == null)
                $tmp = URL::asset('images/profile.png');
            else
                $tmp = URL::asset('images/userPhotos/' . $tmp->photo);

            $uId->photo = $tmp;
            $user = User::whereId($uId->srcId);
            $uId->firstName = $user->firstName;
            $uId->lastName = $user->lastName;
            $uId->bio = Bio::whereUId($uId->srcId)->first()->description;
            $uId->state = State::whereId(UserState::whereUId($uId->srcId)->first()->stateId)->name;
            $uId->field = Field::whereId($user->fieldId)->name;
            switch ($uId->mode) {
                case getValueInfo('rafigh'):
                    $uId->mode = "رفیق";
                    break;
                case getValueInfo('dost'):
                    $uId->mode = "دوست";
                    break;
                case getValueInfo('ashna'):
                default:
                    $uId->mode = "آشنا";
                    break;
            }
        }

        echo json_encode($uIds);

    }
}