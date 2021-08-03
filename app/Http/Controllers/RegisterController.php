<?php

namespace App\Http\Controllers;

use App\models\Master;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;

class RegisterController extends Controller {

    private function generateUserName() {

        $rand = rand(1, 10000);
        $username = "p" . $rand;

        while (User::whereUserName($username)->count() > 0) {
            $rand = rand(1, 10000);
            $username = "p" . $rand;
        }

        return $username;
    }

    private function addUsers($users, $level) {
        
        $counter = 2;

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Persolio");
        $objPHPExcel->getProperties()->setLastModifiedBy("Persolio");
        $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'رمز عبور');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'نام کاربری');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'نام خانوادگی');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'نام');

        foreach ($users as $user) {

            if(count($user) != 14)
                continue;

            if(Master::whereNID($user[2])->count() > 0 || !_custom_check_national_code($user[2]))
                continue;

            $tmp = new User();
            $tmp->firstName = $user[0];
            $tmp->lastName = $user[1];
            $tmp->sex = ($user[5] == 1);
            $tmp->level = $level;
            $pas = generateActivationCode();
            $username = $this->generateUserName();
            $tmp->invitationCode = $pas;
            $tmp->educationalCode = $pas;
            $tmp->username = $username;
            $tmp->password = Hash::make($pas);
            $tmp->phoneNum = $user[3];
            $tmp->status = 1;
            $tmp->email = $user[6];
            $tmp->fieldId = $user[10];

            $redundantInfo = new Master();

            try {
                $tmp->save();

                $redundantInfo->fieldId = $user[7];
                $redundantInfo->specId = $user[8];
                $redundantInfo->NID = $user[2];
                $redundantInfo->uId = $tmp->id;
                $redundantInfo->tel = $user[4];
                $redundantInfo->jobNo = $user[9];
                $redundantInfo->degreeLevel = $user[11];
                $redundantInfo->university = $user[12];
                $redundantInfo->jobAddress = $user[13];
                $redundantInfo->save();

                $objPHPExcel->getActiveSheet()->setCellValue('A' . ($counter), $user[0]);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . ($counter), $user[1]);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . ($counter), $username);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . ($counter), $pas);
                $counter++;
            }
            catch (\Exception $x) {
                $tmp->delete();
                $redundantInfo->delete();
            }
        }

        $fileName = __DIR__ . "/../../../public/registrations/report_" . random_int(1000, 2000) . ".xlsx";

        $objPHPExcel->getActiveSheet()->setTitle('اطلاعات ثبت نام');

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);

        header('Content-Description: File Transfer');
        header('Content-Type: application/force-download');
        header("Content-Disposition: attachment; filename=\"" . basename($fileName) . "\";");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        ob_clean();
        flush();
        readfile($fileName); //showing the path to the server where the file is to be download
        unlink($fileName);
    }

    public function doAdviserRegister() {
        return $this->groupRegistration(getValueInfo("adviserLevel"));
    }

    public function doCertifierRegister() {
        return $this->groupRegistration(getValueInfo("certificateLevel"));
    }
    
    private function groupRegistration($level) {

        $err = "";

        if(isset($_FILES["group"])) {

            $file = $_FILES["group"]["name"];

            if(!empty($file)) {

                $path = __DIR__ . '/../../../public/tmp/' . $file;

                $err = uploadCheck($path, "group", "اکسل ثبت نام گروهی", 20000000, "xlsx");

                if (empty($err)) {
                    upload($path, "group", "اکسل ثبت نام گروهی");
                    $excelReader = PHPExcel_IOFactory::createReaderForFile($path);
                    $excelObj = $excelReader->load($path);
                    $workSheet = $excelObj->getSheet(0);
                    $users = array();
                    $lastRow = $workSheet->getHighestRow();
                    $cols = $workSheet->getHighestColumn();

                    if ($cols < 'O') {
                        unlink($path);
                        $err = "تعداد ستون های فایل شما معتبر نمی باشد";
                    } else {
                        for ($row = 2; $row <= $lastRow; $row++) {

                            if($workSheet->getCell('B' . $row)->getValue() == "")
                                break;

                            $users[$row - 2][0] = $workSheet->getCell('B' . $row)->getValue();
                            $users[$row - 2][1] = $workSheet->getCell('C' . $row)->getValue();
                            $users[$row - 2][2] = $workSheet->getCell('D' . $row)->getValue();
                            $users[$row - 2][3] = $workSheet->getCell('E' . $row)->getValue();
                            $users[$row - 2][4] = $workSheet->getCell('F' . $row)->getValue();
                            $users[$row - 2][5] = $workSheet->getCell('G' . $row)->getValue();
                            $users[$row - 2][6] = $workSheet->getCell('H' . $row)->getValue();
                            $users[$row - 2][7] = $workSheet->getCell('I' . $row)->getValue();
                            $users[$row - 2][8] = $workSheet->getCell('J' . $row)->getValue();
                            $users[$row - 2][9] = $workSheet->getCell('K' . $row)->getValue();
                            $users[$row - 2][10] = $workSheet->getCell('L' . $row)->getValue();
                            $users[$row - 2][11] = $workSheet->getCell('M' . $row)->getValue();
                            $users[$row - 2][12] = $workSheet->getCell('N' . $row)->getValue();
                            $users[$row - 2][13] = $workSheet->getCell('O' . $row)->getValue();
                        }
                        unlink($path);
                        $this->addUsers($users, $level);
                        $err = "فایل کاربرانی که به درستی به سامانه اضافه گردیدند تولید شد";
                    }

                }
            }
        }

        if(empty($err))
            $err = "لطفا فایل اکسل مورد نیاز را آپلود نمایید";

        if($level == getValueInfo('adviserLevel'))
            return view('certifiers', ['url' => route('doAdviserRegister'), 'err' => $err]);

        return view('certifiers', ['url' => route('doCertifierRegister'), 'err' => $err]);
    }

}
