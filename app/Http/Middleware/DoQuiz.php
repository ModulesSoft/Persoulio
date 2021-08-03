<?php

namespace App\Http\Middleware;

use App\models\QEntry;
use App\models\Quiz;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DoQuiz
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if($user->level == 1) {

            $quiz = Quiz::whereId(1);
            if ($quiz == null)
                return Redirect::route('preQuiz', ['quizId' => Quiz::first()->id]);

            $qEntry = QEntry::whereUId($user->id)->whereQId($quiz->id)->first();

            if ($qEntry == null || $qEntry->status == 0)
                return Redirect::route("preQuiz", ['quizId' => Quiz::first()->id]);

            if($quiz->status == 0)
                return Redirect::route('waitForResult');
        }

        return $next($request);
    }
}
