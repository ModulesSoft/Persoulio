<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'QuizRegistry'
 *
 * @property integer $id
 * @property integer $quizId
 * @property integer $uId
 * @method static \Illuminate\Database\Query\Builder|\App\models\QuizRegistry whereQuizId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\QuizRegistry whereUId($value)
 */

class QuizRegistry extends Model {

    protected $table = 'quizRegistry';
    public $timestamps = false;

    public static function whereId($target) {
        return QuizRegistry::find($target);
    }
}
