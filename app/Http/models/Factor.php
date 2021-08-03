<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model {

    protected $table = 'factor';
    public $timestamps = false;

    public static function whereId($target) {
        return Factor::find($target);
    }
}
