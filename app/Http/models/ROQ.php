<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'ROQ'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $qoqId
 * @property integer $result
 * @method static \Illuminate\Database\Query\Builder|\App\models\ROQ whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ROQ whereQoqId($value)
 */

class ROQ extends Model {

    protected $table = 'ROQ';
    public $timestamps = false;

    public static function whereId($target) {
        return ROQ::find($target);
    }
}
