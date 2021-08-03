<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'QEntry'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $qId
 * @property string $timeEntry
 * @property boolean $status
 * @method static \Illuminate\Database\Query\Builder|\App\models\QEntry whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\QEntry whereQId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\QEntry whereStatus($value)
 */

class QEntry extends Model {

    protected $table = 'qEntry';
    public $timestamps = false;

    public static function whereId($target) {
        return QEntry::find($target);
    }
}
