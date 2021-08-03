<?php

namespace App\Http\Controllers;

use App\models\ActivationCode;
use App\models\AdditionalInfo;
use App\models\Bio;
use App\models\ConfigModel;
use App\models\EntryYear;
use App\models\Event;
use App\models\EventDay;
use App\models\EventRegistry;
use App\models\Field;
use App\models\Follower;
use App\models\GeneralShowMe;
use App\models\Instagram;
use App\models\Like;
use App\models\MessageBox;
use App\models\PatientDates;
use App\models\QEntry;
use App\models\Quiz;
use App\models\RequestModel;
use App\models\ResultSeen;
use App\models\State;
use App\models\Telegram;
use App\models\Transaction;
use App\models\User;
use App\models\UserLike;
use App\models\UserPhoto;
use App\models\UserPlanAssign;
use App\models\UserRate;
use App\models\UserState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function getPersonalData() {

        $user = Auth::user();

        $bio = Bio::whereUId($user->id)->first();

        if ($bio == null)
            $bio = "";
        else
            $bio = $bio->description;

        $tips = DB::select('select tip.name from tip, userTip WHERE tip.id = tipId and uId = ' . $user->id);

        $tipOut = "";
        foreach ($tips as $tip) {
            $tipOut .= $tip->name . " - ";
        }

        $userPhoto = UserPhoto::whereUId($user->id)->first();
        if ($userPhoto == null)
            $photo = URL::asset('images/profile.png');
        else
            $photo = URL::asset('images/userPhotos/' . $userPhoto->photo);

        echo json_encode(['bio' => $bio, 'photo' => $photo, 'tip' => $tipOut, 'uses' => $user]);
    }

    public function home() {
        return view('home');
    }

    public function sendMail() {

        if(isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["email"])) {

            $data = makeValidInput($_POST["text"]);

            $status = Mail::send('emails.template', array('data' => $data), function ($message) {
                $message->from(makeValidInput($_POST["email"]), 'Laravel');
                $message->to('info@persoulio.com')->subject(makeValidInput($_POST["title"]));
            });

            if($status)
                echo "ok";
            else
                echo "nok2";
            return;
        }

        echo "nok";
    }
    
    public function signIn($err = "")
    {

        if (Auth::check()) {

            if (Auth::user()->level == 2)
                return Redirect::route("profile");

            $condition = ['uId' => Auth::user()->id, 'status' => 1];
            if (QEntry::where($condition)->count() > 0)
                return Redirect::route("profile");
            return Redirect::route("preQuiz", ['quizId' => Quiz::first()->id]);
        }
        return view('login', array('err' => $err));
    }

    public function signUp()
    {
        return view('signUp', array('entryYears' => EntryYear::all(), 'fields' => Field::orderBy('id', 'ASC')->get()));
    }

    public function checkAuth()
    {
        if (isset($_POST["username"]) && isset($_POST["password"])) {


            if (Auth::attempt(array('username' => makeValidInput($_POST["username"]), 'password' => makeValidInput($_POST["password"])), true)
                || Auth::attempt(array('educationalCode' => makeValidInput($_POST["username"]), 'password' => makeValidInput($_POST["password"])), true)
            ) {
                
                if (Auth::user()->level == 2)
                    return "profile";

                $condition = ['uId' => Auth::user()->id, 'status' => 1];
                if (QEntry::where($condition)->count() > 0 || Auth::user()->level == getValueInfo("adminLevel")) {
                    if (UserLike::whereUId(Auth::user()->id)->count() == 0)
//                        return Redirect::to('likesList');
                        return "likesList";
//                    return Redirect::route('events');
                    return "events";
                }

                return Redirect::route('preQuiz', ['quizId' => Quiz::first()->id]);
            }
        }

//        return $this->signIn('نام کاربری و یا رمزعبور اشتباه است');
        return "nok";
    }

    public function sendActivation()
    {

        if (isset($_POST["phoneNum"]) && isset($_POST["code"]) && isset($_POST["entryYear"])
//            && isset($_POST["field"])
            && isset($_POST["sex"]) && isset($_POST["educationalCode"])
            && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["username"])
            && isset($_POST["password"])
        ) {
            $phoneNum = makeValidInput($_POST["phoneNum"]);
            $activationCode = ActivationCode::wherePhoneNum($phoneNum)->whereCode(makeValidInput($_POST["code"]))->first();

//            if ($activationCode == null) {
//                echo "nok1";
//                return;
//            }

            $user = new User();
            $user->sex = makeValidInput($_POST["sex"]);
            $user->educationalCode = makeValidInput($_POST["educationalCode"]);
            $user->entryYearId = makeValidInput($_POST["entryYear"]);
            $user->firstName = makeValidInput($_POST["firstName"]);
            $user->lastName = makeValidInput($_POST["lastName"]);
            $user->phoneNum = $phoneNum;
            $user->fieldId = 1;//makeValidInput($_POST["field"]);
            $user->username = makeValidInput($_POST["username"]);
            $user->password = Hash::make(makeValidInput($_POST["password"]));
            $user->money = 0;
            $user->level = 1;
            $user->status = 1;
//            $user->invitationCode = 0;
            if(isset($_POST["birthDay"])) {
                $user->birthDay = convertDateToString(makeValidInput($_POST["birthDay"]));
            }

            try {
                $user->save();
                if(isset($_POST["invitationCode"])) {
                    $introducer = User::whereInvitationCode(makeValidInput($_POST["invitationCode"]))->first();
                    if($introducer != null) {
                        $count = Transaction::whereForWhat(getValueInfo('introduceTransaction'))->whereUId($introducer->id)->count();

                        $t1 = new Transaction();
                        $t1->amount = ceil($count / 5) * 5;
                        $t1->uId = $introducer->id;
                        $t1->forWhat = getValueInfo('introduceTransaction');
                        $t1->additionalId = -1;
                        $t1->save();

                        $t2 = new Transaction();
                        $t2->amount = 5;
                        $t2->uId = $user->id;
                        $t2->forWhat = getValueInfo('introduceTransaction');
                        $t2->additionalId = -1;
                        $t2->save();
                    }
                }

                if($activationCode != null)
                    $activationCode->delete();
                return "ok";
            } catch (\Exception $x) {
                return $x;
            }
        }
        echo "nok2";
//        else{
//            if(!isset($_POST["phoneNum"])){
//                echo "phone";
//            }
//            if(!isset($_POST["code"])){
//                echo "code";
//            }
//            if(!isset($_POST["entryYear"])){
//                echo "year";
//            }
//            if(!isset($_POST["field"])){
//                echo "field";
//            }
//            if(!isset($_POST["sex"])){
//                echo "sex";
//            }
//            if(!isset($_POST["educationalCode"])){
//                echo "edu code";
//            }
//            if(!isset($_POST["firstName"])){
//                echo "firstname";
//            }
//            if(!isset($_POST["lastName"])){
//                echo "lastname";
//            }
//            if(!isset($_POST["username"])
//                && isset($_POST["password"])){
//                echo "username";
//            }
//            if(!isset($_POST["password"])){
//                echo "password";
//            }
//        }
    }

    public function getActivation()
    {

//die("home");
        if (isset($_POST["phoneNum"])) {
//die("umad");
            $phoneNum = makeValidInput($_POST["phoneNum"]);

            if (User::wherePhoneNum($phoneNum)->count() > 0) {
                echo json_encode(['status' => 'nok3', 'reminderTime' => 300]);
                return;
            }

            $activationCode = ActivationCode::wherePhoneNum($phoneNum)->first();

            if ($activationCode == null) {
                $activationCode = new ActivationCode();
                $activationCode->phoneNum = $phoneNum;
            } else if (time() - $activationCode->sendTime < 300) {
                echo json_encode(['status' => 'nok1', 'reminderTime' => 300 - time() + $activationCode->sendTime]);
                return;
            }

            $activationCode->code = generateActivationCode();
            $activationCode->sendTime = time();
            $status = sendSMS($activationCode->phoneNum, $activationCode->code, "password");

            if ($status != -1) {
                $activationCode->save();
                echo json_encode(['status' => 'ok', 'reminderTime' => 300]);
                return;
            }
        }

        echo json_encode(['status' => 'nok2', 'reminderTime' => 300]);
    }

    public function checkEducationalCode()
    {

        if (isset($_POST["entryYear"]) && isset($_POST["educationalCode"])) {

            $educationalCode = makeValidInput($_POST["educationalCode"]);

            if (strlen($educationalCode) != 9) {
                echo "nok";
                return;
            }

            $entryYear = EntryYear::whereId(makeValidInput($_POST["entryYear"]));
            if ($entryYear == null) {
                echo "nok";
                return;
            }

            if ($entryYear->name != $educationalCode[4] . $educationalCode[5]) {
                echo "nok";
                return;
            }

            if (User::whereEducationalCode($educationalCode)->count() > 0)
                echo "nok2";
            else
                echo "ok";

            return;

        }

        echo "nok";
    }

    public function checkUserName()
    {

        if (isset($_POST["username"])) {

            $username = makeValidInput($_POST["username"]);

            if (User::whereUserName($username)->count() > 0)
                echo "nok";
            else
                echo "ok";

            return;

        }

        echo "nok";
    }

    public function profile() {

        $user = Auth::user();

//        $qId = Quiz::first()->id;
//
//        if (ResultSeen::whereUId($user->id)->whereQId($qId)->count() == 0)
//            return Redirect::route('result', ['quizId' => $qId]);


        return view('profile', array('user' => $user,
            'srcRequest' => RequestModel::whereSrcId($user->id)->count(),
            'destRequest' => RequestModel::whereDestId($user->id)->count(),
            'followers' => (Follower::whereSrcId($user->id)->count() + Follower::whereDestId($user->id)->count())
        ));

    }

    public function waitForResult() {

        return Redirect::to('dashboard');

//        return view('waitForResult');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::intended('/login');
    }

    public function setting($err = "")
    {

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

        $status = GeneralShowMe::whereUId(Auth::user()->id)->first();

        $userState = UserState::whereUId($user->id)->first();
        if ($userState == null)
            $userState = -1;
        else
            $userState = $userState->stateId;

        return view('setting', array('user' => $user, 'bio' => $bio, 'status' => $status, 'err' => $err,
            'states' => State::all(), 'userState' => $userState, 'tips' => $tips, 'fields' => Field::all()));
    }

    public function updateProfile()
    {

        $msg = "";

        if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["field"]) &&
            isset($_POST["phoneNum"]) && isset($_POST["email"])
        ) {

            $user = Auth::user();

            $user->firstName = makeValidInput($_POST["firstName"]);
            $user->lastName = makeValidInput($_POST["lastName"]);
            $user->fieldId = makeValidInput($_POST["field"]);
            $user->educationalCode = makeValidInput($_POST["educationalCode"]);
            $phone = makeValidInput($_POST["phoneNum"]);
            if ($user->phoneNum != $phone) {
                if (User::wherePhoneNum($phone)->count() != 0)
                    $msg = "شماره همراه وارد شده در سامانه موجود است";
                else
                    $user->phoneNum = $phone;
            }
            $user->email = makeValidInput($_POST["email"]);

            $user->save();

        }

        if (empty($msg))
            return Redirect::route('setting');
        return $this->setting($msg);

    }

    public function changePas()
    {

        if (isset($_POST["currPas"]) && isset($_POST["newPas"]) && isset($_POST["confirmNewPas"])) {

            $user = Auth::user();

            if (Hash::check(makeValidInput($_POST["currPas"]), $user->password)) {

                $newPas = makeValidInput($_POST["newPas"]);
                $confirmPas = makeValidInput($_POST["confirmNewPas"]);

                if ($newPas == $confirmPas) {
                    $user->password = Hash::make($newPas);
                    $user->save();
                    return $this->setting("عملیات مورد نظر با موفقیت انجام پذیرفت");
                } else
                    return $this->setting("رمز جدید و تکرار آن با هم یکی نیستند");
            }
        }

        return $this->setting("رمز وارد شده نامعتبر است");
    }

    public function submitPhoto()
    {

        $err = "اشکالی در آپلود تصویر رخ داده است";
        if (isset($_FILES["photo"])) {

            $file = $_FILES["photo"];

            $fileName = $file["name"];
//			$targetFile = $_SERVER["DOCUMENT_ROOT"] . '/jalal/public/images/userPhotos/' . $file["name"];
            $targetFile =  'images/userPhotos/' . $file["name"];
            $count = 2;

            while (file_exists($targetFile)) {
                $fileName = $count . $file["name"];
//				$targetFile = $_SERVER["DOCUMENT_ROOT"] . '/jalal/public/images/userPhotos/' . $fileName;
                $targetFile =  'images/userPhotos/' . $file["name"];
                $count++;
            }

            $err = uploadCheck($targetFile, 'photo', 'تغییر تصویر کاربری', 3000000, -1);
            if (empty($err)) {
                $err = upload($targetFile, 'photo', 'تغییر تصویر کاربری');
                if (empty($err)) {

                    $userPhoto = UserPhoto::whereUId(Auth::user()->id)->first();
                    if ($userPhoto == null) {
                        $userPhoto = new UserPhoto();
                        $userPhoto->uId = Auth::user()->id;
                    } else {
                        $oldFile = $userPhoto->photo;
//						$_SERVER["DOCUMENT_ROOT"] . '/jalal/public/images/userPhotos/' . $oldFile
                        if (file_exists( 'images/userPhotos/' . $oldFile))
                            unlink( 'images/userPhotos/' . $oldFile);
                    }

                    $userPhoto->photo = $fileName;
                    $userPhoto->save();
                    return Redirect::to('setting');
                }
            }
        }
        return $this->setting($err);
    }

    public function imageUploadTinyMce(){
        /*******************************************************
         * Only these origins will be allowed to upload images *
         ******************************************************/
        $accepted_origins = array("http://localhost", "http://192.168.1.1", "http://example.com");

        /*********************************************
         * Change this line to set the upload folder *
         *********************************************/
        $imageFolder = "images/contentPhotos";

        reset ($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])){
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                // same-origin requests won't set an origin. If the origin is set, it must be valid.
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }

            /*
              If your script needs to receive cookies, set images_upload_credentials : true in
              the configuration and enable the following two headers.
            */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            echo json_encode(array('location' => $filetowrite));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
    }

    public function contentShowComplete($contentId)
    {

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

        $w = DB::select('select sP.id, sP.text as photo, sTe.text as text, sTi.text as title from sitePhoto sP, siteText sTe, siteTitle sTi WHERE sP.id = ' . $contentId . ' and sP.id = sTe.id and sP.id = sTi.id');

        if ($w == null || count($w) == 0)
            return Redirect::route('profile');

        return view('contentShowComplete', array('user' => $user, 'tips' => $tips, 'bio' => $bio,
            'content' => $w[0]));
    }

    public function resetPas($err = "")
    {
        return view('resetPas', array('err' => $err));
    }

    public function doResetPas()
    {

        if (isset($_POST["username"]) && isset($_POST["phoneNum"])) {

            $phoneNum = makeValidInput($_POST["phoneNum"]);

            $user = User::whereUsername(makeValidInput($_POST["username"]))->wherePhonenum($phoneNum)->first();
            if ($user == null) {
                $user = User::whereEducationalcode(makeValidInput($_POST["username"]))->wherePhonenum($phoneNum)->first();
                if ($user == null) {
                    return $this->resetPas('err');
                }
            }

            $newPas = rand(10000, 99999);
            $user->password = Hash::make($newPas);
            $user->save();
            sendSMSReset($phoneNum, $newPas);
            return $this->resetPas('success');
        }

        return Redirect::route('resetPas');
    }

    public function sendTelegramId()
    {

        if (isset($_POST["telegramId"])) {

            $telegramId = makeValidInput($_POST["telegramId"]);

            if (Telegram::whereTelegramUserName($telegramId)->count() > 0) {
                echo "nok";
                return;
            }

            $telegram = new Telegram();
            $telegram->telegramUserName = $telegramId;
            $telegram->uId = Auth::user()->id;

            try {

                $showMe = GeneralShowMe::whereUId(Auth::user()->id)->first();
                if ($showMe == null) {
                    echo "nok";
                    return;
                }
                $showMe->telegramId = 1;

                $showMe->save();
                $telegram->save();
                echo "ok";
                return;
            } catch (\Exception $x) {}
        }
        echo "nok";
    }

    public function sendInstagramId()
    {

        if (isset($_POST["instagramId"])) {

            $instagramId = makeValidInput($_POST["instagramId"]);

            if (Instagram::whereInstagramUserName($instagramId)->count() > 0) {
                echo "nok";
                return;
            }

            $instagram = new Instagram();
            $instagram->instagramUserName = $instagramId;
            $instagram->uId = Auth::user()->id;

            try {

                $showMe = GeneralShowMe::whereUId(Auth::user()->id)->first();
                if ($showMe == null) {
                    echo "nok";
                    return;
                }
                $showMe->instagramId = 1;

                $showMe->save();
                $instagram->save();
                echo "ok";
                return;
            } catch (\Exception $x) {}
        }
        echo "nok";
    }

    public function changePhoneStatus()
    {

        if (isset($_POST["phoneStatus"])) {

            $showMe = GeneralShowMe::whereUId(Auth::user()->id)->first();

            if (makeValidInput($_POST["phoneStatus"]) == "ok")
                $showMe->phoneNum = 1;
            else
                $showMe->phoneNum = 0;

            $showMe->save();
        }
    }

    public function changeTelegramStatus()
    {

        if (isset($_POST["telegramStatus"])) {

            $showMe = GeneralShowMe::whereUId(Auth::user()->id)->first();

            if ($showMe == null)
                return;

            if (makeValidInput($_POST["telegramStatus"]) == "ok") {

                if (Telegram::whereUId(Auth::user()->id)->count() == 0) {
                    echo "new";
                    return;
                }

                $showMe->telegramId = 1;
            } else
                $showMe->telegramId = 0;

            $showMe->save();
        }
    }

    public function changeInstagramStatus()
    {

        if (isset($_POST["instagramStatus"])) {

            $showMe = GeneralShowMe::whereUId(Auth::user()->id)->first();

            if ($showMe == null)
                return;

            if (makeValidInput($_POST["instagramStatus"]) == "ok") {

                if (Instagram::whereUId(Auth::user()->id)->count() == 0) {
                    echo "new";
                    return;
                }

                $showMe->instagramId = 1;
            } else
                $showMe->instagramId = 0;

            $showMe->save();
        }
    }

    public function saveBio()
    {

        if (isset($_POST["desc"]) && isset($_POST["state"])) {

            $uId = Auth::user()->id;
            $bio = Bio::whereUId($uId)->first();
            if ($bio == null) {
                $bio = new Bio();
                $bio->uId = $uId;
            }

            $bio->description = makeValidInput($_POST["desc"]);

            try {
                $bio->save();
                echo "ok";

                $userState = UserState::whereUId($uId)->first();
                if ($userState == null) {
                    $userState = new UserState();
                    $userState->uId = $uId;
                }
                $userState->stateId = makeValidInput($_POST["state"]);
                try {
                    $userState->save();
                } catch (\Exception $x) {
                }
                return;
            } catch (\Exception $x) {
            }
        }
        echo "nok";
    }

    public function likesList()
    {

        $likes = Like::all();
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

        foreach ($likes as $itr) {

            $condition = ['uId' => $user->id, 'likeId' => $itr->id];

            if (UserLike::where($condition)->count() > 0)
                $itr->selected = true;
            else
                $itr->selected = false;
        }

        return view('likesList', array('user' => $user, 'tips' => $tips, 'bio' => $bio, 'likes' => $likes));

    }

    public function changeLike()
    {

        if (isset($_POST["likeId"])) {

            $uId = Auth::user()->id;
            $likeId = makeValidInput($_POST["likeId"]);

            $like = UserLike::whereUId($uId)->whereLikeId($likeId)->first();

            if ($like == null) {
                $like = new UserLike();
                $like->uId = $uId;
                $like->likeId = $likeId;
                $like->save();
            } else {
                $like->delete();
            }

        }
    }

    public function saveMyDates()
    {
        $userId = $_POST['userId'];
        $cId = $_POST['cId'];
        $days = [];
        for ($i = 0; $i < 7; $i++)
            $days[$i] = "";
        if (isset($_POST['day1']))
            $days[0] = $_POST['day1'];
        if (isset($_POST['day2']))
            $days[1] = $_POST['day2'];
        if (isset($_POST['day3']))
            $days[2] = $_POST['day3'];
        if (isset($_POST['day4']))
            $days[3] = $_POST['day4'];
        if (isset($_POST['day5']))
            $days[4] = $_POST['day5'];
        if (isset($_POST['day6']))
            $days[5] = $_POST['day6'];
        if (isset($_POST['day7']))
            $days[6] = $_POST['day7'];

        $isNoDay = true;
        for ($i = 0; $i < 7; $i++) {
            if ($days[$i] != null) {
                $days[$i] = 1;
                $isNoDay = false;
            }
        }
        if ($isNoDay) {
            try {
                DB::transaction(function () use ($userId, $cId) {
                    UserPlanAssign::whereRaw('uId = ' . $userId . ' and contentId = ' . $cId)->delete();
                    echo "ok";
                });
            } catch (\Exception $x) {
                die($x);
                $err = "اشکالی در  حذف نامتان از لیست رخ داده است";
                return route('events', $err);
            }
        } else {
            try {
                DB::transaction(function () use ($days, $userId, $cId) {
                    UserPlanAssign::whereRaw('uId = ' . $userId . ' and contentId = ' . $cId)->delete();
                    echo "ok";
//                    die("ok");
                    $tmp = new UserPlanAssign();
                    $tmp->uId = $userId;
                    $tmp->contentId = $cId;
                    $tmp->day1 = $days[0];
                    $tmp->day2 = $days[1];
                    $tmp->day3 = $days[2];
                    $tmp->day4 = $days[3];
                    $tmp->day5 = $days[4];
                    $tmp->day6 = $days[5];
                    $tmp->day7 = $days[6];

                    $tmp->save();
                });
            } catch (\Exception $x) {
                die($x);
                $err = "اشکالی در ثبت نامتان رخ داده است";
            }
        }
        return Redirect::route('events');

    }

    public function getUserRate() {
        $tmp = UserRate::whereUId(Auth::user()->id)->first();
        if($tmp != null)
            echo $tmp->rate;
        else
            echo 0;
    }

    public function exchangeUserRate() {

        if(isset($_POST["amount"])) {

            $tmp = UserRate::whereUId(Auth::user()->id)->first();
            if($tmp != null) {
                $amount = makeValidInput($_POST["amount"]);
                if($tmp->rate < $amount) {
                    echo "nok3";
                    return;
                }

                $config = ConfigModel::first();
                if($config == null) {
                    echo "nok4";
                    return;
                }

                $user = Auth::user();
                $oldMoney = $user->money;

                $user->money = $user->money + $config->exchangeRate * $tmp->rate;
                try {
                    $user->save();
                    $tmp->rate -= $amount;
                    $tmp->save();
                    echo "ok";
                }
                catch (\Exception $x) {
                    $user->money = $oldMoney;
                    try {
                        $user->save();
                    }
                    catch (\Exception $xx) {}

                    echo "nok6";
                }
                return;
            }
            else {
                echo "nok1";
                return;
            }
        }

        echo "nok2";

    }

    public function getMyNotifications() {

        $uId = Auth::user()->id;
        $messages = MessageBox::whereUId($uId)->whereSeen(false)->get();

        $out = [];
        $counter = 0;

        foreach ($messages as $message) {
            $out[$counter++] = $message->message;
            $message->delete();
        }

        $events = EventRegistry::whereUId($uId)->get();
        $today = getToday()["date"];
        $nextWeek = getToday("+6 days")["date"];

        $week = [convertStringToDate($today) => [],
            convertStringToDate(getToday("+1 days")["date"]) => [],
            convertStringToDate(getToday("+2 days")["date"]) => [],
            convertStringToDate(getToday("+3 days")["date"]) => [],
            convertStringToDate(getToday("+4 days")["date"]) => [],
            convertStringToDate(getToday("+5 days")["date"]) => [],
            $nextWeek => []];

        foreach ($events as $event) {
            $e = Event::whereId($event->eventId);
            if($e->mode != getValueInfo('mag')) {
                $days = EventDay::whereEventId($event->eventId)->where('date', '>=', $today)->where('date', '<=', $nextWeek)->orderBy('date', 'ASC')->get();
                foreach ($days as $day) {
                    $week[convertStringToDate($day->date)][count($week[convertStringToDate($day->date)])] = "رویداد " . $e->name . " خودت رو فراموش نکنی در تاریخ " . convertStringToDate($day->date);
                }
            }
        }

        $days = PatientDates::where('date', '>=', $today)->where('date', '<=', $nextWeek)->get();
        foreach ($days as $day) {
            $week[convertStringToDate($day->date)][count($week[convertStringToDate($day->date)])] = "رویداد " . $e->name . " خودت رو فراموش نکنی در تاریخ " . convertStringToDate($day->date);
        }

        echo json_encode(['messages' => $out, 'week' => $week]);
    }

    public function setMyAdditionalInfo() {

        if(isset($_POST["NID"]) && isset($_POST["fatherName"])) {

            $nid = makeValidInput($_POST["NID"]);

            if(!_custom_check_national_code($nid)) {
                echo "nok1";
                return;
            }

            $uId = Auth::user()->id;
            $additionalInfo = AdditionalInfo::whereUID($uId)->first();

            if($additionalInfo == null) {
                $additionalInfo = new AdditionalInfo();
                $additionalInfo->uId = $uId;
            }

            $additionalInfo->fatherName = makeValidInput($_POST["fatherName"]);
            $additionalInfo->NID = $nid;

            try {
                $additionalInfo->save();
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok3";
            }

            return;
        }

        echo "nok2";

    }
}
