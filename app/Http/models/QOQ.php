<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'QOQ'
 *
 * @property integer $id
 * @property integer $questionId
 * @property integer $quizId
 * @property integer $qNo
 * @method static \Illuminate\Database\Query\Builder|\App\models\QOQ whereQuestionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\QOQ whereQuizId($value)
 */

class QOQ extends Model {

    protected $table = 'QOQ';
    public $timestamps = false;

    public static function whereId($target) {
        return QOQ::find($target);
    }
}
