<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'UserPhoto'
 *
 * @property integer $id
 * @property integer $uId
 * @property string photo
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserPhoto whereUId($value)
 */

class UserPhoto extends Model {

    protected $table = 'userPhoto';
    public $timestamps = false;

    public static function whereId($target) {
        return UserPhoto::find($target);
    }
}
