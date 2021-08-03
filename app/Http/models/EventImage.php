<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'EventImage'
 *
 * @property integer $id
 * @property integer $eventId
 * @property string $pic
 * @method static \Illuminate\Database\Query\Builder|\App\models\EventImage whereEventId($value)
 */

class EventImage extends Model {

    protected $table = 'eventImage';
    public $timestamps = false;

    public static function whereId($target) {
        return EventImage::find($target);
    }
}
