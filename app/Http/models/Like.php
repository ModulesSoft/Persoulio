<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $table = 'likes';
    public $timestamps = false;

    public static function whereId($target) {
        return Like::find($target);
    }
}
