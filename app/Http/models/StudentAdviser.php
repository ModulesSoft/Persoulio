<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'StudentAdviser'
 *
 * @property integer $id
 * @property integer $studentId
 * @property integer $adviserId
 * @property boolean $status
 * @method static \Illuminate\Database\Query\Builder|\App\models\StudentAdviser whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\StudentAdviser whereAdviserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\StudentAdviser whereStatus($value)
 * @mixin \Eloquent
 */


class StudentAdviser extends Model {

    protected $table = 'studentsAdviser';
    public $timestamps = false;

    public static function whereId($target) {
        return StudentAdviser::find($target);
    }
}