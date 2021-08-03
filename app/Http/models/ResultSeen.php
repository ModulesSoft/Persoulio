<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'ResultSeen'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $qId
 * @method static \Illuminate\Database\Query\Builder|\App\models\ResultSeen whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ResultSeen whereQId($value)
 */

class ResultSeen extends Model {

    protected $table = 'resultSeen';
    public $timestamps = false;

    public static function whereId($target) {
        return ResultSeen::find($target);
    }
}
