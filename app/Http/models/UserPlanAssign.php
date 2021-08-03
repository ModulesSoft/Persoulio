<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class UserPlanAssign extends Model {

    protected $table = 'UserPlanAssign';
    public $timestamps = false;

    public static function whereId($target) {
        return UserPlanAssign::find($target);
    }
}
