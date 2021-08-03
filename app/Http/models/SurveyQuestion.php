<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'QEntry'
 *
 * @property integer $id
 * @property string $text
 */

class SurveyQuestion extends Model {

    protected $table = 'surveyQuestion';
    public $timestamps = false;

    public static function whereId($target) {
        return SurveyQuestion::find($target);
    }
}
