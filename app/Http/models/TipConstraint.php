<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'TipConstraint'
 *
 * @property integer $id
 * @property integer $tipId
 * @property integer $factorId
 * @property integer $floor
 * @property integer $ceil
 * @method static \Illuminate\Database\Query\Builder|\App\models\TipConstraint whereTipId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\TipConstraint whereFactorId($value)
 */

class TipConstraint extends Model {

    protected $table = 'tipConstraint';
    public $timestamps = false;

    public static function whereId($target) {
        return TipConstraint::find($target);
    }

}
