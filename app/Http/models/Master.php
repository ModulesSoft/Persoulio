<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'Master'
 *
 * @property integer $id
 * @property integer $uId
 * @property string $tel
 * @property string $NID
 * @property string $jobAddress
 * @property string $university
 * @property integer $fieldId
 * @property integer $specId
 * @property integer $degreeLevel
 * @property integer $jobNo
 * @property string $pic
 * @method static \Illuminate\Database\Query\Builder|\App\models\Master whereUID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Master whereNID($value)
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */

class Master extends Model {

    protected $table = 'master';
    public $timestamps = false;

    public static function whereId($target) {
        return Master::find($target);
    }

}
