<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'PatientDates'
 *
 * @property integer $id
 * @property integer $studentAdviserId
 * @property string $date
 * @method static \Illuminate\Database\Query\Builder|\App\models\PatientDates whereStudentAdviserId($value)
 * @mixin \Eloquent
 */


class PatientDates extends Model {

    protected $table = 'patientDates';
    public $timestamps = false;

    public static function whereId($target) {
        return PatientDates::find($target);
    }
}