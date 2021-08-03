<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'Follower'
 *
 * @property integer $id
 * @property integer $srcId
 * @property integer $destId
 * @property integer $mode
 * @method static \Illuminate\Database\Query\Builder|\App\models\Follower whereSrcId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Follower whereDestId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Follower whereMode($value)
 */

class Follower extends Model {

    protected $table = 'follower';
    public $timestamps = false;

    public static function whereId($target) {
        return Follower::find($target);
    }
}
