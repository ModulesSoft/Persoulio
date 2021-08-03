<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    protected $table = 'question';
    public $timestamps = false;

    public static function whereId($target) {
        return Question::find($target);
    }
}
