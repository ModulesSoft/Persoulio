<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'Bio'
 *
 * @property integer $id
 * @property integer $uId
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\App\models\Bio whereUId($value)
 */

class Bio extends Model {

    protected $table = 'bio';
    public $timestamps = false;

    public static function whereId($target) {
        return Bio::find($target);
    }
}