<?php

namespace App\Http\Controllers;

use App\models\Factor;
use App\models\Tip;
use App\models\TipConstraint;
use Illuminate\Support\Facades\Redirect;

class TipController extends Controller {

    public function tips() {
        return view('tips', ['tips' => Tip::orderBy('id', 'ASC')->get()]);
    }

    public function showTipDetail($tipId) {

        $tipConstraint = TipConstraint::whereTipId($tipId)->get();
        foreach ($tipConstraint as $itr) {
            $itr->factorId = Factor::whereId($itr->factorId)->name;
        }


        return view('showTipDetail', ['details' => $tipConstraint, 'tipId' => $tipId]);
    }

    public function addTip() {
        return view('addTip', ['factors' => Factor::all(), 'url' => route('doAddTip')]);
    }

    public function editTip($tipId) {

        $factors = Factor::all();
        $consts = [];
        $counter = 0;

        foreach ($factors as $itr) {
            $const = TipConstraint::whereTipId($tipId)->whereFactorId($itr->id)->first();
            if($const != null)
                $consts[$counter++] = $const;
            else {
                $tmp = new TipConstraint();
                $tmp->tipId = $tipId;
                $tmp->factorId = $itr->id;
                $tmp->floor = 0;
                $tmp->ceil = 0;
                $tmp->save();
                $consts[$counter++] = $tmp;
            }
        }

        
        return view('addTip', ['factors' => $factors, 'url' => route('doEditTip'), 'consts' => $consts, 'tipId' => $tipId]);
    }

    public function deleteTip() {

        if(isset($_POST["tipId"])) {
            try {
                Tip::destroy(makeValidInput($_POST["tipId"]));
                echo "ok";
                return;
            }
            catch (\Exception $x) {}
        }
        echo "nok";
    }

    public function doAddTip() {

        if(isset($_POST["name"])) {

            $tip = new Tip();
            $tip->name = makeValidInput($_POST["name"]);
            try {

                $tip->save();

                $factors = Factor::all();

                foreach ($factors as $itr) {
                    if(!isset($_POST["min_" . $itr->id]) || !isset($_POST["max_" . $itr->id])) {
                        return Redirect::route('profile');
                    }
                    $itr->floor = makeValidInput($_POST["min_" . $itr->id]);
                    $itr->ceil = makeValidInput($_POST["max_" . $itr->id]);

                    if($itr->floor > $itr->ceil) {
                        dd("سقف باید بزرگ تر از کف باشد");
                    }
                }

                foreach ($factors as $itr) {
                    $tmp = new TipConstraint();
                    $tmp->tipId = $tip->id;
                    $tmp->factorId = $itr->id;
                    $tmp->ceil = $itr->ceil;
                    $tmp->floor = $itr->floor;

                    $tmp->save();
                }

            }
            catch (\Exception $x) {
                dd($x->getMessage());
            }
        }

        return Redirect::route('tips');
    }

    public function doEditTip() {

        if(isset($_POST["tipId"])) {

            $factors = Factor::all();
            $tipId = makeValidInput($_POST['tipId']);

            foreach ($factors as $itr) {
                if(!isset($_POST["min_" . $itr->id]) || !isset($_POST["max_" . $itr->id])) {
                    return Redirect::route('profile');
                }
                $itr->floor = makeValidInput($_POST["min_" . $itr->id]);
                $itr->ceil = makeValidInput($_POST["max_" . $itr->id]);

                if($itr->floor > $itr->ceil) {
                    dd("سقف باید بزرگ تر از کف باشد");
                }
            }

            foreach ($factors as $itr) {
                $tmp = TipConstraint::whereTipId($tipId)->whereFactorId($itr->id)->first();
                if($tmp != null) {
                    $tmp->ceil = $itr->ceil;
                    $tmp->floor = $itr->floor;
                    $tmp->save();
                }
            }

        }

        return Redirect::route('tips');
    }

}
