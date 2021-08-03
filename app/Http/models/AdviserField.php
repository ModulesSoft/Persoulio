<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'AdviserField'
 *
 * @property integer $id
 * @property string $name
 */


class AdviserField extends Model {

    protected $table = 'adviserField';
    public $timestamps = false;

    public static function whereId($target) {
        return AdviserField::find($target);
    }
}
