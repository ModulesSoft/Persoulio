<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'Certificate'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $eventId
 * @property string $code
 * @property string $publishDate
 * @method static \Illuminate\Database\Query\Builder|\App\models\Certificate whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Certificate whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Certificate whereCode($value)
 */

class Certificate extends Model {

    protected $table = 'certificate';
    public $timestamps = false;

    public static function whereId($target) {
        return Certificate::find($target);
    }
}
