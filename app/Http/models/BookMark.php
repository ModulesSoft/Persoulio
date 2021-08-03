<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class BookMark extends Model {

    protected $table = 'bookMark';
    public $timestamps = false;

    public static function whereId($target) {
        return BookMark::find($target);
    }
}
