<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'MessageBox'
 *
 * @property integer $id
 * @property integer $uId
 * @property string $message
 * @property string $sdate
 * @property boolean $seen
 * @method static \Illuminate\Database\Query\Builder|\App\models\MessageBox whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\MessageBox whereSeen($value)
 */

class MessageBox extends Model {

    protected $table = 'messageBox';
    public $timestamps = false;

    public static function whereId($target) {
        return MessageBox::find($target);
    }
}
