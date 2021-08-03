<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'UserSurvey'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $eventId
 * @property integer $surveyQuestionId
 * @property integer $opinion
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserSurvey whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserSurvey whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\UserSurvey whereSurveyQuestionId($value)
 */

class UserSurvey extends Model {

    protected $table = 'userSurvey';
    public $timestamps = false;

    public static function whereId($target) {
        return UserSurvey::find($target);
    }
}
