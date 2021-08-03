<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


class ConfigModel extends Model {

    protected $table = 'config';
    public $timestamps = false;

    public static function whereId($target) {
        return ConfigModel::find($target);
    }
}
