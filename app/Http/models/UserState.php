<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'UserState'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $stateId
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserState whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserState whereStateId($value)
 */

class UserState extends Model {

    protected $table = 'userState';
    public $timestamps = false;

    public static function whereId($target) {
        return UserState::find($target);
    }
}
