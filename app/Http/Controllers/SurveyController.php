<?php

namespace App\Http\Controllers;


use App\models\Bio;
use App\models\Event;
use App\models\Like;
use App\models\SurveyQuestion;
use App\models\Tip;
use App\models\UserPhoto;
use App\models\UserSurvey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SurveyController extends Controller {
    
    public function manageSurveys() {

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


        return view('manageSurveys', array('user' => $user, 'tips' => $tips, 'bio' => $bio, 'AllTips' => Tip::orderBy('id', 'ASC')->get(), 'likes' => Like::all()));
    }

    public function getSurveyQuestions() {
        $surveys = SurveyQuestion::all();
        foreach ($surveys as $survey)
            $survey->text = html_entity_decode($survey->text);
        echo json_encode($surveys);
    }

    public function addSurveyQuestion() {

        if(isset($_POST["text"])) {
            $surveyQuestion = new SurveyQuestion();
            $surveyQuestion->text = makeValidInput($_POST["text"]);
            $surveyQuestion->save();
            echo "ok";
        }
    }

    public function deleteSurveyQuestion() {

        if(isset($_POST["id"])) {
            try {
                SurveyQuestion::destroy(makeValidInput($_POST["id"]));
                echo "ok";
            }
            catch (\Exception $x) {}
        }
    }

    public function editSurveyQuestion() {

        if(isset($_POST["id"]) && isset($_POST["text"])) {
            try {
                $tmp = SurveyQuestion::whereId(makeValidInput($_POST["id"]));
                if($tmp != null) {
                    $tmp->text = makeValidInput($_POST["text"]);
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

    public function setOpinion() {

        if(isset($_POST["eventId"]) && isset($_POST["qId"]) && isset($_POST["opinion"])) {

            $qId = makeValidInput($_POST["qId"]);
            $eventId = makeValidInput($_POST["eventId"]);
            $opinion = makeValidInput($_POST["opinion"]);

            if(SurveyQuestion::whereId($qId) == null)
                return "nok1";

            if(Event::whereId($eventId) == null)
                return "nok2";

            $uId = Auth::user()->id;
            $userSurvey = UserSurvey::whereUId($uId)->whereSurveyQuestionId($qId)->first();

            if($userSurvey == null) {
                $userSurvey = new UserSurvey();
                $userSurvey->surveyQuestionId = $qId;
                $userSurvey->uId = $uId;
            }

            $userSurvey->opinion = $opinion;
            $userSurvey->save();
            return "ok";
        }

        return "nok3";
    }
    
}