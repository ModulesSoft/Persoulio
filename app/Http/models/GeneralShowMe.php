<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'GeneralShowMe'
 *
 * @property integer $id
 * @property integer $uId
 * @property boolean $telegramId
 * @property boolean $instagramId
 * @property boolean $phoneNum
 * @method static \Illuminate\Database\Query\Builder|\App\models\GeneralShowMe whereUId($value)
 */

class GeneralShowMe extends Model {

    protected $table = 'generalShowMe';
    public $timestamps = false;

    public static function whereId($target) {
        return GeneralShowMe::find($target);
    }
}
