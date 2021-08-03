<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'AnsFactor'
 *
 * @property integer $id
 * @property integer $qoqId
 * @property integer $ansId
 * @property integer $factorId
 * @property integer $mark
 * @property integer $choiceNo
 * @method static \Illuminate\Database\Query\Builder|\App\models\AnsFactor whereQOQId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\AnsFactor whereFactorId($value)
 */

class AnsFactor extends Model {

    protected $table = 'ansFactor';
    public $timestamps = false;

    public static function whereId($target) {
        return AnsFactor::find($target);
    }
}
