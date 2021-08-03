<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Telegram'
 *
 * @property integer $id
 * @property integer $uId
 * @property string $telegramUserName
 * @method static \Illuminate\Database\Query\Builder|\App\models\Telegram whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Telegram whereTelegramUserName($value)
 */

class Telegram extends Model {

    protected $table = 'telegram';
    public $timestamps = false;

    public static function whereId($target) {
        return Telegram::find($target);
    }
}
