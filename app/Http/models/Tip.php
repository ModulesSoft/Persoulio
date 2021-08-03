<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model {

    protected $table = 'tip';
    public $timestamps = false;

    public static function whereId($target) {
        return Tip::find($target);
    }
}
