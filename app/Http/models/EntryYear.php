<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class EntryYear extends Model {

    protected $table = 'entryYear';
    public $timestamps = false;


    public static function whereId($target) {
        return EntryYear::find($target);
    }
}
