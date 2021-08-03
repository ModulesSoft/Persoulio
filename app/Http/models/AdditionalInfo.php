<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'AdditionalInfo'
 *
 * @property integer $id
 * @property integer $uId
 * @property string $NID
 * @property string $fatherName
 * @method static \Illuminate\Database\Query\Builder|\App\models\AdditionalInfo whereUID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\AdditionalInfo whereNID($value)
 */


class AdditionalInfo extends Model {

    protected $table = 'additionalInfo';
    public $timestamps = false;

    public static function whereId($target) {
        return AdditionalInfo::find($target);
    }
}
