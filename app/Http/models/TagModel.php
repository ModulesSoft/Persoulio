<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'TagModel'
 *
 * @property integer $id
 * @property integer $mode
 * @property string $name
 * @property boolean $general
 * @method static \Illuminate\Database\Query\Builder|\App\models\TagModel whereMode($value)
 */

class TagModel extends Model {

    protected $table = 'tag';
    public $timestamps = false;

    public static function whereId($target) {
        return TagModel::find($target);
    }
}