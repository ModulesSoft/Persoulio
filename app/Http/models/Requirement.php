<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Requirement'
 *
 * @property integer $id
 * @property integer $eventIdSrc
 * @property integer $eventIdDest
 * @property boolean $isQuizSrc
 * @property boolean $isQuizDest
 * @method static \Illuminate\Database\Query\Builder|\App\models\Requirement whereEventIdSrc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Requirement whereEventIdDest($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Requirement whereIsQuizSrc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Requirement whereIsQuizDest($value)
 */

class Requirement extends Model {

    protected $table = 'requirement';
    public $timestamps = false;

    public static function whereId($target) {
        return Requirement::find($target);
    }
}
