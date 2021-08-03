<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class State extends Model {

    protected $table = 'state';
    public $timestamps = false;

    public static function whereId($target) {
        return State::find($target);
    }
}
