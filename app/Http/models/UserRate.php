<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'UserRate'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $rate
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserRate whereUId($value)
 */

class UserRate extends Model {

    protected $table = 'userRate';
    public $timestamps = false;

    public static function whereId($target) {
        return UserRate::find($target);
    }
}
