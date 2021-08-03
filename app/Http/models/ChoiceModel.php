<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class ChoiceModel extends Model {

    protected $table = 'choice';
    public $timestamps = false;

    public static function whereId($target) {
        return ChoiceModel::find($target);
    }
}