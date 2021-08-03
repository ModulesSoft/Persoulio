<?php

namespace App\Http\Controllers;


use App\models\NotifSentence;
use Illuminate\Support\Facades\Redirect;
use PHPExcel_IOFactory;

class SentenceController extends Controller {
    
    public function addSentences($sentences) {

        $err = "";

        foreach ($sentences as $sentence) {
            $tmp = new NotifSentence();
            $tmp->tipId = $sentence[0];
            $tmp->sentence = $sentence[1];
            $tmp->date = $sentence[2];

            try {
                $tmp->save();
            }
            catch (\Exception $x) {

                if(empty($err))
                    $err = "بجز موارد زیر بقیه به درستی اضافه گردیدند " . '<br/>';

                $err .= "تیپ " . $sentence[1] . "در تاریخ  " . $sentence[2] . "<br/>";
            }
        }

        return $err;
    }

    public function daySentences() {

        $sentences = NotifSentence::where('date', '>=' , getToday()["date"])->get();

        foreach ($sentences as $sentence) {
            $sentence->date = convertStringToDate($sentence->date);
        }

        return view('daySentences', ['sentences' => $sentences,
            'url' => route('doUploadNotifSentences')]);
    }

    public function deleteNotifSentence() {

        if(isset($_POST["sentenceId"])) {
            NotifSentence::destroy(makeValidInput($_POST["sentenceId"]));
        }

        return Redirect::route('daySentences');

    }

    public function doUploadNotifSentences() {

        $err = "";

        if(isset($_FILES["sentences"])) {

            $file = $_FILES["sentences"]["name"];

            if(!empty($file)) {

                $path = __DIR__ . '/../../../public/tmp/' . $file;


                $err = uploadCheck($path, "sentences", "اکسل جملات روز", 20000000, "xlsx");

                if (empty($err)) {
                    upload($path, "sentences", "اکسل جملات روز");
                    $excelReader = PHPExcel_IOFactory::createReaderForFile($path);
                    $excelObj = $excelReader->load($path);
                    $workSheet = $excelObj->getSheet(0);
                    $sentences = array();
                    $lastRow = $workSheet->getHighestRow();
                    $cols = $workSheet->getHighestColumn();

                    if ($cols < 'D') {
                        unlink($path);
                        $err = "تعداد ستون های فایل شما معتبر نمی باشد";
                    } else {
                        for ($row = 2; $row <= $lastRow; $row++) {

                            if($workSheet->getCell('B' . $row)->getValue() == "")
                                break;

                            $sentences[$row - 2][0] = $workSheet->getCell('B' . $row)->getValue();
                            $sentences[$row - 2][1] = $workSheet->getCell('C' . $row)->getValue();
                            $sentences[$row - 2][2] = $workSheet->getCell('D' . $row)->getValue();
                        }
                        unlink($path);
                        $err = $this->addSentences($sentences);
                        if(empty($err))
                            return Redirect::route('daySentences');
                    }
                }
            }
        }

        if(empty($err))
            $err = "لطفا فایل اکسل مورد نیاز را آپلود نمایید";

        return view('daySentences', ['err' => $err, 'url' => route('doUploadNotifSentences')]);
    }

    public function getDaySentence() {

        if(isset($_POST["tipId"])) {
            $date = getToday()["date"];
            $tmp = NotifSentence::whereTipDate(makeValidInput($_POST["tipId"]), $date);
            if($tmp != null)
                echo $tmp->sentence;
        }
    }

}
