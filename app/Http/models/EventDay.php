<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'EventDay'
 *
 * @property integer $id
 * @property integer $eventId
 * @property string $date
 * @property string $startTime
 * @method static \Illuminate\Database\Query\Builder|\App\models\EventDay whereEventId($value)
 */

class EventDay extends Model {

    protected $table = 'eventDay';
    public $timestamps = false;

    public static function whereId($target) {
        return EventDay::find($target);
    }
}
