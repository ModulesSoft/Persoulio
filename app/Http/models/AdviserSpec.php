<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'AdviserSpec'
 *
 * @property integer $id
 * @property string $name
 */


class AdviserSpec extends Model {

    protected $table = 'adviserSpec';
    public $timestamps = false;

    public static function whereId($target) {
        return AdviserSpec::find($target);
    }
}
