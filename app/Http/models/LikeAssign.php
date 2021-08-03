<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'LikeAssign'
 *
 * @property integer $id
 * @property integer $likeId
 * @property integer $contentId
 * @method static \Illuminate\Database\Query\Builder|\App\models\LikeAssign whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\LikeAssign whereLikeId($value)
 */

class LikeAssign extends Model {

    protected $table = 'likeAssign';
    public $timestamps = false;

    public static function whereId($target) {
        return LikeAssign::find($target);
    }
}
