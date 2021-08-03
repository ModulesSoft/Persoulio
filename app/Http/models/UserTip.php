<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'UserTip'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $tipId
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserTip whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserTip whereTipId($value)
 */

class UserTip extends Model {

    protected $table = 'userTip';
    public $timestamps = false;

    public static function whereId($target) {
        return UserTip::find($target);
    }
}
