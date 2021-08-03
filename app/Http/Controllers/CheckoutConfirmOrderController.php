<?php

namespace App\Http\Controllers;
use App\models\AdditionalInfo;
use App\models\Event;
use App\models\EventRegistry;
use App\models\Offer;
use App\models\Quiz;
use App\models\QuizRegistry;
use App\models\Requirement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutConfirmOrderController extends Controller {

    public function doPayment($forWhat, $additionalId, $offCode = "") {
        try {
            $gateway = \Gateway::mellat();
            $gateway->setCallback(url('callback'));

            $user = Auth::user();

            switch ($forWhat) {
                case getValueInfo('chargeTransaction'):
                    $price = $additionalId;
                    break;
                case getValueInfo('eventTransaction'):

                    $event = Event::whereId($additionalId);
                    if($event == null)
                        return Redirect::route('profile');

                    if(EventRegistry::whereEventId($additionalId)->whereUId($user->id)->count() > 0)
                        return view('shouldRegistry', ['msg' => 'شما قبلا در این رویداد ثبت نام کرده اید']);
                    
                    if($event->mode == getValueInfo('tunnel') && AdditionalInfo::whereUID($user->id)->count() == 0)
                        return view('shouldRegistry', ['msg' => 'ابتدا باید اطلاعات تکمیلی خود را پر نمایید']);

                    $requirements = Requirement::whereEventIdDest($event->id)->whereIsQuizDest(false)->get();
                    foreach ($requirements as $requirement) {
                        if($requirement->isQuizSrc) {
                            if(QuizRegistry::whereQuizId($requirement->id)->whereUId($user->id)->count() == 0)
                                return view('shouldRegistry', ['msg' => 'شما ابتدا باید در آزمون ' . Quiz::whereId($requirement->id)->name . " ثبت نام کنید"]);
                        }
                        else {
                            if(EventRegistry::whereEventId($requirement->id)->whereUId($user->id)->count() == 0)
                                return view('shouldRegistry', ['msg' => 'شما ابتدا باید در دوره ' . Event::whereId($requirement->id)->name . " ثبت نام کنید"]);
                        }
                    }

                    $price = floor($event->price * (100 - $event->off) / 100);
                    break;

                case getValueInfo('quizTransaction'):

                    $quiz = Quiz::whereId($additionalId);
                    if($quiz == null)
                        return Redirect::route('profile');

                    if(QuizRegistry::whereQuizId($additionalId)->whereUId(Auth::user()->id)->count() > 0)
                        return view('shouldRegistry', ['msg' => 'شما قبلا در این آزمون ثبت نام کرده اید']);

                    $requirements = Requirement::whereEventIdDest($quiz->id)->whereIsQuizDest(true)->get();
                    foreach ($requirements as $requirement) {
                        if($requirement->isQuizSrc) {
                            if(QuizRegistry::whereQuizId($requirement->id)->whereUId($user->id)->count() == 0)
                                return view('shouldRegistry', ['msg' => 'شما ابتدا باید در آزمون ' . Quiz::whereId($requirement->id)->name . " ثبت نام کنید"]);
                        }
                        else {
                            if(EventRegistry::whereEventId($requirement->id)->whereUId($user->id)->count() == 0)
                                return view('shouldRegistry', ['msg' => 'شما ابتدا باید در دوره ' . Event::whereId($requirement->id)->name . " ثبت نام کنید"]);
                        }
                    }

                    $price = floor($quiz->price * (100 - $quiz->off) / 100);
                    break;

                default:
                    return Redirect::route('profile');
            }

            if(!empty($offCode)) {
                if(checkOffCodeValidation($offCode)) {
                    $code = Offer::whereCode($offCode)->first();
                    if($code->offerKind == getValueInfo('staticOffer'))
                        $price -= $code->amount;
                    else
                        $price -= floor(100 - $code->amount / 100);
                }
            }

            if($forWhat != getValueInfo('chargeTransaction')) {
                $price -= $user->money;
            }

            $gateway->price($price)->ready($additionalId, $forWhat, $offCode);
            $refId =  $gateway->refId();
            $transID = $gateway->transactionId();
// Your code here
            return view('mellat-redirector', ['refId' => $refId, 'price' => 1000, 
                'callBack' => route('callback')]);
//            return $gateway->redirect();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

}
