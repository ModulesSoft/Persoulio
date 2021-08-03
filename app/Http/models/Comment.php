<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Event'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $eventId
 * @property boolean $status
 * @property string $text
 * @method static \Illuminate\Database\Query\Builder|\App\models\Comment whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Comment whereEventId($value)
 */

class Comment extends Model {

    protected $table = 'comment';
    public $timestamps = false;

    public static function whereId($target) {
        return Comment::find($target);
    }
}