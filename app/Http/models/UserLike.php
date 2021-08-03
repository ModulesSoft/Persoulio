<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'UserLike'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $likeId
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserLike whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserLike whereLikeId($value)
 */

class UserLike extends Model {

    protected $table = 'userLikes';
    public $timestamps = false;

    public static function whereId($target) {
        return UserLike::find($target);
    }
}
