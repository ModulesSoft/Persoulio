<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'Block'
 *
 * @property integer $id
 * @property integer $srcId
 * @property integer $destId
 * @method static \Illuminate\Database\Query\Builder|\App\models\Block whereSrcId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Block whereDestId($value)
 */

class Block extends Model {

    protected $table = 'block';
    public $timestamps = false;

    public static function whereId($target) {
        return Block::find($target);
    }
}
