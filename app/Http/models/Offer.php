<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Offer'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $amount
 * @property string $code
 * @property boolean $offerKind
 * @property string $expireTime
 * @method static \Illuminate\Database\Query\Builder|\App\models\Offer whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Offer whereCode($value)
 * @mixin \Eloquent
 */


class Offer extends Model {

    protected $table = 'offer';
    public $timestamps = false;

    public static function whereId($val) {
        return Offer::find($val);
    }
}