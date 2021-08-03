<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'RequestModel'
 *
 * @property integer $id
 * @property integer $srcId
 * @property integer $destId
 * @property integer $mode
 * @method static \Illuminate\Database\Query\Builder|\App\models\RequestModel whereSrcId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\RequestModel whereDestId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\RequestModel whereMode($value)
 */

class RequestModel extends Model {

    protected $table = 'request';
    public $timestamps = false;

    public static function whereId($target) {
        return RequestModel::find($target);
    }
}
