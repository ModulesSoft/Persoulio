<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'NotifSentence'
 *
 * @property integer $id
 * @property integer $tipId
 * @property string $sentence
 * @property string $date
 * @method static \Illuminate\Database\Query\Builder|\App\models\NotifSentence whereTipId($value)
 */

class NotifSentence extends Model {

    protected $table = 'notifSentence';
    public $timestamps = false;

    public static function whereId($target) {
        return NotifSentence::find($target);
    }

    public static function whereTipDate($tipId, $date) {
        return NotifSentence::whereTipId($tipId)->where('date', '=', $date)->first();
    }
}
