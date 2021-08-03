<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'ActivationCode'
 *
 * @property integer $id
 * @property string $phoneNum
 * @property string $code
 * @property string $sendTime
 * @method static \Illuminate\Database\Query\Builder|\App\models\ActivationCode wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ActivationCode whereCode($value)
 */


class ActivationCode extends Model {

    protected $table = 'activationCode';
    public $timestamps = false;

    public static function whereId($target) {
        return ActivationCode::find($target);
    }
}
