<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'Event'
 *
 * @property integer $id
 * @property integer $price
 * @property integer $counter
 * @property integer $mode
 * @property integer $subMode
 * @property integer $duration
 * @property integer $point
 * @property integer $level
 * @property integer $off
 * @property string $launcher
 * @property string $description
 * @property string $name
 * @property string $place
 * @method static \Illuminate\Database\Query\Builder|\App\models\Event whereMode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Event whereDuration($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Event whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Event whereSubMode($value)
 */

class Event extends Model {

    protected $table = 'event';
    public $timestamps = false;

    public static function whereId($target) {
        return Event::find($target);
    }
}
