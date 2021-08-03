<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'EventRegistry'
 *
 * @property integer $id
 * @property integer $eventId
 * @property integer $uId
 * @method static \Illuminate\Database\Query\Builder|\App\models\EventRegistry whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\EventRegistry whereUId($value)
 */

class EventRegistry extends Model {

    protected $table = 'eventRegistry';
    public $timestamps = false;

    public static function whereId($target) {
        return EventRegistry::find($target);
    }
}
