<?php

use App\models\Tip;
use App\models\TipConstraint;
use App\models\UserTip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function makeValidInput($input) {
    $input = addslashes($input);
    $input = trim($input);
    if(get_magic_quotes_gpc())
        $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function generateActivationCode() {

    $rand = rand(10000, 99999);

    while (\App\models\User::whereInvitationCode($rand)->count() > 0) {
        $rand = rand(10000, 99999);
    }

    return $rand;
}

function uploadCheck($target_file, $name, $section, $limitSize, $ext) {
    $err = "";
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $check = true;

    if($ext != "xlsx")
        $check = getimagesize($_FILES[$name]["tmp_name"]);

    $uploadOk = 1;

    if($check === false) {
        $err .= "فایل ارسالی در قسمت " . $section . " معتبر نمی باشد" .  "<br />";
        $uploadOk = 0;
    }


    if ($uploadOk == 1 && $_FILES[$name]["size"] > $limitSize) {
        $limitSize /= 1000000;
        $limitSize .= "MB";
        $err .=  "حداکثر حجم مجاز برای بارگذاری تصویر " .  " <span>" . $limitSize . " </span>" . "می باشد" . "<br />";
    }

    $imageFileType = strtolower($imageFileType);

    if($ext != -1 && $imageFileType != $ext)
        $err .= "شما تنها فایل های $ext. را می توانید در این قسمت آپلود نمایید" . "<br />";

    return $err;
}

function upload($target_file, $name, $section) {

    try {
        move_uploaded_file($_FILES[$name]["tmp_name"], $target_file);
    }
    catch (Exception $x) {
//        die($x);
        return "اشکالی در آپلود تصویر در قسمت " . $section . " به وجود آمده است" . "<br />";
    }
    return "";
//    return $err;
}

function _custom_check_national_code($code) {

    if(!preg_match('/^[0-9]{10}$/',$code))
        return false;

    for($i=0;$i<10;$i++)
        if(preg_match('/^'.$i.'{10}$/',$code))
            return false;
    for($i=0,$sum=0;$i<9;$i++)
        $sum+=((10-$i)*intval(substr($code, $i,1)));
    $ret=$sum%11;
    $parity=intval(substr($code, 9,1));
    if(($ret<2 && $ret==$parity) || ($ret>=2 && $ret==11-$parity))
        return true;
    return false;
}

function getStatusSMS($msgId) {

    require 'src/KavenegarApi.php';

    try{
        $api = new \Kavenegar\KavenegarApi("4836666C696247676762504666386A336846366163773D3D");
        var_dump($api->Status($msgId));
    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
}

function getSendTime($msgId) {

    require 'src/KavenegarApi.php';

    try{
        $api = new \Kavenegar\KavenegarApi("4836666C696247676762504666386A336846366163773D3D");
        return $api->Select($msgId)[0]->date;
    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
    return -1;
}

function sendSMSReset($destNum, $text) {

    try {
        $api = new \Kavenegar\KavenegarApi("34486E4B466B7974575655674B5770623745627752673D3D");
//        $sender = "10000008008080";
//        $result = $api->Send("30006703323323","09214915905","خدمات پیام کوتاه کاوه نگار");
        $result = $api->VerifyLookup($destNum, $text, "", "", "resetPas");

        if($result){
            foreach($result as $r){
                return $r->messageid;
//                echo "messageid = $r->messageid";
//                echo "message = $r->message";
//                echo "status = $r->status";
//                echo "statustext = $r->statustext";
//                echo "sender = $r->sender";
//                echo "receptor = $r->receptor";
//                echo "date = $r->date";
//                echo "cost = $r->cost";
            }
        }
    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        echo $e->errorMessage();
        return -1;
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        echo $e->errorMessage();
        return -1;
    }
    return -1;
}

function sendSMS($destNum, $text, $template, $text2 = "", $text3 = "") {

    try{
        $api = new \Kavenegar\KavenegarApi("34486E4B466B7974575655674B5770623745627752673D3D");
//        $sender = "10000008008080";
//        $result = $api->Send("30006703323323","09214915905","خدمات پیام کوتاه کاوه نگار");
        $result = $api->VerifyLookup($destNum, $text, $text2, $text3, $template);

        if($result){
            foreach($result as $r){
                return $r->messageid;
//                echo "messageid = $r->messageid";
//                echo "message = $r->message";
//                echo "status = $r->status";
//                echo "statustext = $r->statustext";
//                echo "sender = $r->sender";
//                echo "receptor = $r->receptor";
//                echo "date = $r->date";
//                echo "cost = $r->cost";
            }
        }
    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
//        echo $e->errorMessage();
        return -1;
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
//        echo $e->errorMessage();
        return -1;
    }
    return -1;
}

function checkOffCodeValidation($code) {

    $offCode = \App\models\Offer::whereCode($code)->first();

    if($offCode == null || $offCode->uId != Auth::user()->id)
        return false;

    if($offCode->expireTime == null)
        return true;

    return (convertDateToString($offCode->expireTime) >= getToday()["date"]);

}

function getValueInfo($key) {

    $values = ["userLevel" => 1, "adminLevel" => 2, "adviserLevel" => 3, "certificateLevel" => 4,
        'tunnelLevel' => 5, 'funLevel' => 6, 'magLevel' => 7,
        'tunnel' => 1, 'mag' => 2, 'fun' => 3,
        "firstPage" => 1, "event" => 2, "all" => 3, "tip" => 4, 'simple' => 1, 'avg' => 2, 'advance' => 3,
        'introduceTransaction' => 1, 'chargeTransaction' => 2, 'eventTransaction' => 3, 'quizTransaction' => 4,
        'rafigh' => 1, 'dost' => 2, 'ashna' => 3,
        'staticOffer' => 1, 'dynamicOffer' => 0,
        'diplom' => 1, 'foghDiplom' => 2, 'lisans' => 3, 'foghLisans' => 4, 'doctor' => 5
    ];

    return $values[$key];
}

function getToday($amount = '') {

    include_once 'jdate.php';

    $jalali_date = jdate("c", $amount);

    $date_time = explode('-', $jalali_date);

    $subStr = explode('/', $date_time[0]);

    $day = $subStr[0] . $subStr[1] . $subStr[2];

    $time = explode(':', $date_time[1]);

    $time = $time[0] . $time[1];

    return ["date" => $day, "time" => $time];
}

function convertStringToTime($time) {
    return $time[0] . $time[1] . ":" . $time[2] . $time[3];
}

function convertStringToDate($date) {
    return $date[0] . $date[1] . $date[2] . $date[3] . '/' . $date[4] . $date[5] . '/' . $date[6] . $date[7];
}

function convertDateToString($date) {

    $subStrD = explode('/', $date);
    if(count($subStrD) != 3)
        $subStrD = explode('-', $date);

    return $subStrD[0] . $subStrD[1] . $subStrD[2];
}

function convertTimeToString($time) {
    $subStrT = explode(':', $time);
    return $subStrT[0] . $subStrT[1];
}