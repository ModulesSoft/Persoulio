<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'Best'
 *
 * @property integer $id
 * @property integer $eventId
 * @method static \Illuminate\Database\Query\Builder|\App\models\Best whereEventId($value)
 */

class Best extends Model {

    protected $table = 'best';
    public $timestamps = false;

    public static function whereId($target) {
        return Best::find($target);
    }
}