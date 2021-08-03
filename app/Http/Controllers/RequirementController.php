<?php

namespace App\Http\Controllers;

use App\models\Event;
use App\models\Quiz;
use App\models\Requirement;
use Illuminate\Support\Facades\Redirect;

class RequirementController extends Controller {

    public function requirement() {
        
        $tmp = Requirement::all();

        foreach ($tmp as $itr) {
            if($itr->isQuizSrc)
                $itr->srcName = "آزمون " . Quiz::whereId($itr->eventIdSrc)->name;
            else
                $itr->srcName = "رویداد " . Event::whereId($itr->eventIdSrc)->name;

            if($itr->isQuizDest)
                $itr->destName = "آزمون " . Quiz::whereId($itr->eventIdDest)->name;
            else
                $itr->destName = "رویداد " . Event::whereId($itr->eventIdDest)->name;
        }
        
        return view('requirement', ['requirements' => $tmp]);
    }

    public function doAddRequirement() {

        if(isset($_POST["eventIdSrc"]) && isset($_POST["eventIdDest"]) && isset($_POST["isQuizSrc"]) && isset($_POST["isQuizDest"])) {

            $tmp = new Requirement();
            $tmp->eventIdSrc = makeValidInput($_POST["eventIdSrc"]);
            $tmp->isQuizSrc = (makeValidInput($_POST["isQuizSrc"]) == "true");
            $tmp->eventIdDest = makeValidInput($_POST["eventIdDest"]);
            $tmp->isQuizDest = (makeValidInput($_POST["isQuizDest"]) == "true");
            try {
                $tmp->save();
                echo "ok";
                return;
            }
            catch (\Exception $x) {}
        }
        echo "nok";
    }

    public function deleteRequirement() {

        if(isset($_POST["requirementId"])) {
            Requirement::destroy(makeValidInput($_POST["requirementId"]));
        }

        return Redirect::route('requirement');

    }

}
