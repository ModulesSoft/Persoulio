<?php

namespace App\Http\Controllers;

use App\models\Comment;
use App\models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    public function getComments() {

        if(isset($_POST["eventId"])){//} && isset($_POST["eventId"])) {
//            $page = (makeValidInput($_POST["page"]) - 1) * 40;
            $comments = Comment::whereEventId(makeValidInput($_POST["eventId"]))->get();//->skip($page)->take(40)->get();
            include_once 'jdate.php';
            foreach ($comments as $comment) {
                $userTmp = User::whereId($comment->uId);
                $comment->name = $userTmp->firstName . " " . $userTmp->lastName;
                $comment->username = $userTmp->username;
                $date = explode('-', explode(' ', $comment->created_at)[0]);
                $date = gregorian_to_jalali($date[0], $date[1], $date[2]);
                $date = $date[0] . '/' . $date[1] . '/' . $date[2];
                $comment->date = $date . " " . explode(' ', $comment->created_at)[1];
            }
            echo json_encode($comments);
            return;
        }
        echo "nok";
    }

    public function setStatusComment() {

        if(isset($_POST["commentId"]) && isset($_POST["status"])) {

            $comment = Comment::whereId(makeValidInput($_POST["commentId"]));
            if($comment != null) {
                $comment->status = makeValidInput($_POST["status"]);
            }
            try {
                $comment->save();
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok2 ";
            }
            return;
        }

        echo "nok";
    }

    public function deleteComment() {

        if(isset($_POST["commentId"])) {
            try {
                Comment::destroy(makeValidInput($_POST["commentId"]));
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok2";
            }
            return;
        }
        echo "nok";
    }

    public function addComment() {

        if(isset($_POST["text"]) && isset($_POST["eventId"])) {

            $comment = new Comment();
            $comment->uId = Auth::user()->id;
            $comment->text = makeValidInput($_POST["text"]);
            $comment->eventId = makeValidInput($_POST["eventId"]);

            try {
                $comment->save();
                echo "ok";
            }
            catch (\Exception $x) {
                echo "nok2".$x;
            }
            return;
        }
        echo "nok";
    }


}