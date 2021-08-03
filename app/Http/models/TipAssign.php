<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'TipAssign'
 *
 * @property integer $id
 * @property integer $tipId
 * @property integer $contentId
 * @method static \Illuminate\Database\Query\Builder|\App\models\TipAssign whereTipId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\TipAssign whereContentId($value)
 */

class TipAssign extends Model {

    protected $table = 'tipAssign';
    public $timestamps = false;

    public static function whereId($target) {
        return TipAssign::find($target);
    }
}
