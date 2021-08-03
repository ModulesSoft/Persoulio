<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;


/**
 * An Eloquent Model: 'Instagram'
 *
 * @property integer $id
 * @property integer $uId
 * @property string $instagramUserName
 * @method static \Illuminate\Database\Query\Builder|\App\models\Instagram whereUId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Instagram whereInstagramUserName($value)
 */

class Instagram extends Model {

    protected $table = 'instagram';
    public $timestamps = false;

    public static function whereId($target) {
        return Instagram::find($target);
    }
}
