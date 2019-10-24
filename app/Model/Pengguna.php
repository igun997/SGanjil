<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 06 Jul 2019 07:33:50 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pengguna
 * 
 * @property int $id_pengguna
 * @property string $username
 * @property string $password
 * @property string $level
 *
 * @package App\Model
 */
class Pengguna extends Eloquent
{
	protected $table = 'pengguna';
	protected $primaryKey = 'id_pengguna';
	public $timestamps = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'level'
	];
}
