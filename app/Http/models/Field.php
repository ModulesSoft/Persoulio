<?php


namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Field extends Model {

    protected $table = 'field';
    public $timestamps = false;

    public static function whereId($target) {
        return Field::find($target);
    }
}
