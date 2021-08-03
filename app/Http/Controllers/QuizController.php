<?php

namespace App\Http\Controllers;

use App\models\AnsFactor;
use App\models\Bio;
use App\models\ChoiceModel;
use App\models\Factor;
use App\models\Field;
use App\models\QEntry;
use App\models\QOQ;
use App\models\Question;
use App\models\Quiz;
use App\models\QuizRegistry;
use App\models\ResultSeen;
use App\models\ROQ;
use App\models\Tip;
use App\models\TipConstraint;
use App\models\UserPhoto;
use App\models\UserTip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use PHPExcel_IOFactory;

class QuizController extends Controller {

    public function preQuiz($quizId) {
        return view('preQuiz', ['quizId' => $quizId]);
    }

    public function doQuiz($quizId) {

        $uId = Auth::user()->id;
        $condition = ['uId' => $uId, 'qId' => $quizId, 'status' => 1];

        $quiz = Quiz::whereId($quizId);

        if($quiz == null)
            return Redirect::route('profile');

        if(QEntry::where($condition)->count() > 0) {
            return Redirect::route('profile');
        }

        if(QEntry::whereUId($uId)->count() == 0) {

            if($quiz->price == 0) {
                $quizRegistry = new QuizRegistry();
                $quizRegistry->quizId = $quizId;
                $quizRegistry->uId = $uId;
                try {
                    $quizRegistry->save();
                }
                catch (\Exception $x) {}
            }

            if(QuizRegistry::whereQuizId($quizId)->whereUId($uId)->count() == 0)
                return Redirect::route('shouldRegistry', ['msg' => 'شما باید ابتدا در آزمون مورد نظر ثبت نام نمایید']);
            
            $qEntry = new QEntry();
            $qEntry->uId = $uId;
            $qEntry->qId = $quizId;
            $qEntry->status = 0;
            $qEntry->timeEntry = time();
            try {
                $qEntry->save();
            }
            catch (\Exception $x) {
                dd($x->getMessage());
            }

            $this->fillROQ($uId, $quizId);
        }

        $roqs = DB::select('select result from ROQ, QOQ WHERE uId = ' . $uId . ' and quizId = ' . $quizId . ' and QOQ.id = qoqId order By QOQ.qNo ASC');
        $questions = DB::select('select question.id, question.description, QOQ.id as qoqId from question, QOQ WHERE quizId = ' . $quizId . ' and questionId = question.id order By QOQ.qNo ASC');

        $answered = DB::select('select count(*) as countNum from ROQ, QOQ WHERE uId = ' . $uId . ' and qoqId = QOQ.id and QOQ.quizId = ' . $quizId . ' and result <> 0');
        if($answered == null || count($answered) == 0)
            $answered = 0;
        else
            $answered = $answered[0]->countNum;

        $total = DB::select('select count(*) as countNum from QOQ WHERE QOQ.quizId = ' . $quizId);
        if($total == null || count($total) == 0) {
            return Redirect::route('profile');
        }
        else
            $total = $total[0]->countNum;

        foreach ($questions as $question) {
            $question->choices = DB::select('select c.id, c.text from choice c, ansFactor a WHERE a.qoqId = ' . $question->qoqId . ' and a.ansId = c.id');
        }


        return view('doQuiz', array('questions' => $questions, 'roqs' => $roqs, 'answered' => round($answered / $total * 100, 0)));

    }

    private function fillROQ($uId, $quizId){

        $qoqIds = QOQ::whereQuizId($quizId)->select('id')->get();

        foreach ($qoqIds as $qoqId) {
            $tmp = new ROQ();
            $tmp->uId = $uId;
            $tmp->qoqId = $qoqId->id;
            $tmp->result = 0;
            $tmp->save();
        }

    }

    public function changeAns() {

        if(isset($_POST["qoqId"]) && isset($_POST["newAns"])) {

            $uId = Auth::user()->id;
            $qoq = QOQ::whereId(makeValidInput($_POST["qoqId"]));

            if($qoq == null) {
                echo "nok";
                return;
            }

            $condition = ['qId' => $qoq->quizId, 'uId' => $uId, 'status' => 0];
            if(QEntry::where($condition)->count() == 0) {
                echo "nok";
                return;
            }

            $roq = ROQ::whereQoqId($qoq->id)->whereUId($uId)->first();
            if($roq == null) {
                echo "nok";
                return;
            }

            $roq->result = makeValidInput($_POST["newAns"]);
            $roq->save();

            $answered = DB::select('select count(*) as countNum from ROQ, QOQ WHERE uId = ' . $uId . ' and qoqId = QOQ.id and QOQ.quizId = 1 and result <> 0');
            if($answered == null || count($answered) == 0)
                $answered = 0;
            else
                $answered = $answered[0]->countNum;

            $total = DB::select('select count(*) as countNum from QOQ WHERE QOQ.quizId = 1');
            if($total == null || count($total) == 0) {
                echo "ok";
                return;
            }
            else
                $total = $total[0]->countNum;

            echo round($answered / $total * 100, 0);
            return;
        }

        echo "nok";
    }

    public function endQuiz($quizId) {

        $uId = Auth::user()->id;

        $qEntry = QEntry::whereUId($uId)->whereQId($quizId)->first();
        if($qEntry == null)
            return Redirect::route('preQuiz', ['quizId' => Quiz::first()->id]);

        $qEntry->status = 1;
        $qEntry->save();
        $this->findMyTip($quizId);

        if($quizId == Quiz::first()->id)
            return Redirect::route('waitForResult');

        return Redirect::route('profile');
    }

    function findMyTip($quizId) {

        $uId = Auth::user()->id;

        $marks = DB::select('select sum(a.mark) as sumMark, f.id as factorId from ROQ r, QOQ q, ansFactor a, factor f WHERE q.quizId = ' . $quizId .
            ' and a.factorId = f.id and r.uId = ' . $uId . ' and q.id = r.qoqId and q.id = a.qoqId and 
			r.result = a.choiceNo group by(f.id)');


        $tips = Tip::all();
        $myTips = [];
        foreach ($tips as $tip) {
            $allow = true;

            foreach ($marks as $mark) {
                $constraint = TipConstraint::whereTipId($tip->id)->whereFactorId($mark->factorId)->first();
                if($constraint == null)
                    continue;

                if($constraint->floor > $mark->sumMark || $constraint->ceil < $mark->sumMark) {
                    $allow = false;
                    break;
                }
            }

            if($allow) {
                $myTips[count($myTips)] = $tip->id;
            }
        }

        foreach ($myTips as $myTip) {
            $userTip = new UserTip();
            $userTip->uId = $uId;
            $userTip->tipId = $myTip;
            $userTip->save();
        }

    }

    public function sendQuizResult() {

        if(isset($_POST["quizId"])) {

            $quizId = makeValidInput($_POST["quizId"]);

            $marks = DB::select('select sum(a.mark) as sumMark, f.name, f.id from ROQ r, QOQ q, ansFactor a, factor f WHERE q.quizId = ' . $quizId .
                ' and a.factorId = f.id and r.uId = ' . Auth::user()->id . ' and q.id = r.qoqId and q.id = a.qoqId and' .
			    ' r.result = a.choiceNo group by(f.id)');

            $counter = 0;
            $mainMarks = [];

            foreach ($marks as $mark) {
                $mainMarks[$counter++] = [$mark->sumMark, $mark->name];
            }

            echo json_encode($mainMarks);
        }
    }

    public function sendROQ() {

        if(isset($_POST["quizId"])) {

            $quizId = makeValidInput($_POST["quizId"]);

            $roqs = DB::select('select q.qNo, r.result from ROQ r, QOQ q WHERE q.quizId = ' . $quizId .
                ' and q.id = r.qoqId and r.uId = ' . Auth::user()->id);

            echo json_encode($roqs);
        }
    }

    public function result($quizId) {

        $user = Auth::user();

        if(ResultSeen::whereUId($user->id)->whereQId($quizId)->count() == 0) {
            $resultSeen = new ResultSeen();
            $resultSeen->uId = $user->id;
            $resultSeen->qId = $quizId;
            $resultSeen->save();
        }


        $marks = DB::select('select sum(a.mark) as sumMark, f.name, f.id from ROQ r, QOQ q, ansFactor a, factor f WHERE q.quizId = ' . $quizId .
            ' and a.factorId = f.id and r.uId = ' . $user->id . ' and q.id = r.qoqId and q.id = a.qoqId and 
			r.result = a.choiceNo group by(f.id)');
        
        $counter = 0;
        $mainMarks = [];

        foreach ($marks as $mark) {
            $mainMarks[$counter++] = [$mark->sumMark, $mark->name];
        }

        return view('result', array('marks' => $mainMarks, 'user' => $user));
    }

    public function quizes() {

        $quizes = Quiz::all();

        foreach ($quizes as $quiz) {
            $quiz->qNo = QOQ::whereQuizId($quiz->id)->count();
        }

        return view('quizes', ['quizes' => $quizes]);
    }

    public function addQuiz() {

        if(isset($_POST["name"]) && isset($_POST["price"])) {

            $quiz = new Quiz();
            $quiz->name = makeValidInput($_POST["name"]);
            $quiz->price = makeValidInput($_POST["price"]);

            try {
                $quiz->save();
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok1";
            }
            return;
        }

        echo "nok2";
    }

    public function editQuiz() {

        if(isset($_POST["name"]) && isset($_POST["qId"]) && isset($_POST["price"])) {

            $quiz = Quiz::whereId(makeValidInput($_POST["qId"]));

            if($quiz != null) {
                $quiz->name = makeValidInput($_POST["name"]);
                $quiz->price = makeValidInput($_POST["price"]);

                try {
                    $quiz->save();
                    echo "ok";
                } catch (\Exception $x) {
                    echo "nok1";
                }
                return;
            }
            echo "nok3";
            return;
        }

        echo "nok2";
    }
    
    public function deleteQuiz() {

        if(isset($_POST["quizId"])) {
            try {
                Quiz::destroy(makeValidInput($_POST["quizId"]));
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok1";
            }
            return;
        }
        echo "nok2";
    }

    public function quizOverView($quizId) {

        $qoqs = QOQ::whereQuizId($quizId)->orderBy('qNo', 'ASC')->get();

        foreach ($qoqs as $qoq) {

            $qoq->choices = AnsFactor::whereQOQId($qoq->id)->get();

            foreach ($qoq->choices as $itr) {
                $itr->ans = ChoiceModel::whereId($itr->ansId)->text;
                $itr->field = Factor::whereId($itr->factorId)->name;
            }

            $qoq->question = Question::whereId($qoq->questionId)->description;
        }

        return view('quizOverView', ['qoqs' => $qoqs]);

    }

    public function deleteQOQ() {

        if(isset($_POST["qoqId"])) {

            $qoq = QOQ::whereId(makeValidInput($_POST["qoqId"]));

            if($qoq != null) {
                $quizId = $qoq->quizId;
                $qNo = $qoq->qNo;
                $ansFactors = AnsFactor::whereQOQId($qoq->id)->get();
                foreach ($ansFactors as $ansFactor) {
                    ChoiceModel::destroy($ansFactor->ansId);
                }
                Question::destroy($qoq->questionId);
                DB::update('update qoq set qNo = qNo - 1 WHERE quizId = ' . $quizId . ' and qNo > ' . $qNo);

                return Redirect::route('quizOverView', ['quizId' => $quizId]);
            }
        }

        return Redirect::route('home');
    }

    private function addQuestions($questions, $quizId) {

        foreach ($questions as $question) {

            $qNo = QOQ::whereQuizId($quizId)->count() + 1;

            if(count($question) < 7 || count($question) % 3 != 1)
                continue;
            
            try {

                DB::transaction(function () use ($question, $qNo, $quizId) {

                    $q = new Question();
                    $q->description = $question[0];
                    $q->save();

                    $qoq = new QOQ();
                    $qoq->quizId = $quizId;
                    $qoq->questionId = $q->id;
                    $qoq->qNo = $qNo;

                    $qoq->save();

                    $i = 1;
                    $counter = 1;

                    while (isset($question[$i]) && !empty($question[$i])) {

                        $tmp = new ChoiceModel();
                        $tmp->text = $question[$i++];
                        $tmp->save();

                        $ansFactor = new AnsFactor();
                        $ansFactor->qoqId = $qoq->id;
                        $ansFactor->ansId = $tmp->id;
                        $ansFactor->factorId = $question[$i++];
                        $ansFactor->mark = $question[$i++];
                        $ansFactor->choiceNo = $counter++;

                        $ansFactor->save();
                    }
                });



            }
            catch (\Exception $x) {
                dd($x->getMessage());
            }
        }
    }

    public function addQuizExcel($quizId) {

        $err = "";

        if(isset($_FILES["questions"])) {

            $file = $_FILES["questions"]["name"];

            if(!empty($file)) {

                $path = __DIR__ . '/../../../public/tmp/' . $file;

                $err = uploadCheck($path, "questions", "اکسل سوالات آزمون", 20000000, "xlsx");

                if (empty($err)) {
                    upload($path, "questions", "اکسل سوالات آزمون");
                    $excelReader = PHPExcel_IOFactory::createReaderForFile($path);
                    $excelObj = $excelReader->load($path);
                    $workSheet = $excelObj->getSheet(0);
                    $questions = array();
                    $lastRow = $workSheet->getHighestRow();
                    $cols = $workSheet->getHighestColumn();

                    if ($cols < 'G') {
                        unlink($path);
                        $err = "تعداد ستون های فایل شما معتبر نمی باشد";
                    } else {
                        for ($row = 2; $row <= $lastRow; $row++) {

                            if($workSheet->getCell('A' . $row)->getValue() == "")
                                break;

                            $questions[$row - 2][0] = $workSheet->getCell('A' . $row)->getValue();
                            $questions[$row - 2][1] = $workSheet->getCell('B' . $row)->getValue();
                            $questions[$row - 2][2] = $workSheet->getCell('C' . $row)->getValue();
                            $questions[$row - 2][3] = $workSheet->getCell('D' . $row)->getValue();
                            $questions[$row - 2][4] = $workSheet->getCell('E' . $row)->getValue();
                            $questions[$row - 2][5] = $workSheet->getCell('F' . $row)->getValue();
                            $questions[$row - 2][6] = $workSheet->getCell('G' . $row)->getValue();

                            $char = 'H';
                            $i = 7;
                            $tmp = $workSheet->getCell($char++ . $row)->getValue();
                            while($char <= $cols) {
                                $questions[$row - 2][$i++] = $tmp;
                                $tmp = $workSheet->getCell($char++ . $row)->getValue();
                            }
                        }
                        unlink($path);
                        $this->addQuestions($questions, $quizId);
                        return Redirect::route('quizOverView', ['quizId' => $quizId]);
                    }

                }
            }
        }

        if(empty($err))
            $err = "لطفا فایل اکسل مورد نیاز را آپلود نمایید";

        return view('quizes', ['err' => $err]);
    }

    public function doneQuizes() {

        $qEntry = QEntry::whereUId(Auth::user()->id)->whereStatus(true)->get();

        $out = [];
        $counter = 0;

        include_once 'jdate.php';

        foreach ($qEntry as $itr) {
            $tmp = Quiz::whereId($itr->qId);
            if($tmp != null) {
                $tmp->doneDate = jdate2('Y-m-d', $itr->timeEntry);
                $out[$counter++] = $tmp;
            }
        }

        echo json_encode($out);

    }

    public function getQuizesName() {

        echo json_encode(Quiz::select('id', 'name')->get());

    }

}