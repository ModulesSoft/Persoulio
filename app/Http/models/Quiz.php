<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Quiz'
 *
 * @property integer $id
 * @property integer $off
 * @property integer $price
 * @property string $name
 * @property boolean $status
 */

class Quiz extends Model {

    protected $table = 'quiz';
    public $timestamps = false;

    public static function whereId($target) {
        return Quiz::find($target);
    }
}
