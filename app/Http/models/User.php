<?php


namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $phoneNum
 * @property integer $entryYearId
 * @property string $username
 * @property string $password
 * @property string $birthDay
 * @property integer $educationalCode
 * @property integer $invitationCode
 * @property integer $fieldId
 * @property integer $level
 * @property integer $money
 * @property string $email
 * @property boolean $sex
 * @property boolean $status
 * @method static \Illuminate\Database\Query\Builder|\App\models\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\User whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\User wherePhonenum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\User whereEducationalcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\User whereInvitationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\User whereStatus($value)
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */

class User extends Authenticatable{

	use Notifiable;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */


	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $fillable = [
		'username', 'password'
	];

	protected $hidden = array('password', 'remember_token');

	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function getAuthIdentifier() {
		return $this->getKey();
	}
	public function getAuthPassword() {
		return $this->password;
	}

	public static function whereId($value) {
		return User::find($value);
	}
}