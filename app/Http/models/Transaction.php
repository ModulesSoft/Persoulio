<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Transaction'
 *
 * @property integer $id
 * @property integer $uId
 * @property integer $price
 * @property integer $forWhat
 * @property integer $additionalId
 * @property integer $refId
 * @property string $offCode
 * @method static \Illuminate\Database\Query\Builder|\App\models\Transaction whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Transaction whereForWhat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Transaction whereRefId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Transaction whereAdditionalId($value)
 */

class Transaction extends Model {

    protected $table = 'gateway_transactions';
    public $timestamps = false;

    public static function whereId($target) {
        return Transaction::find($target);
    }
}
