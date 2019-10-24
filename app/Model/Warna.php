<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 06 Jul 2019 07:20:50 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Warna
 * 
 * @property int $id_warna
 * @property string $warna
 * 
 * @property \Illuminate\Database\Eloquent\Collection $barangs
 *
 * @package App\Model
 */
class Warna extends Eloquent
{
	protected $table = 'warna';
	protected $primaryKey = 'id_warna';
	public $timestamps = false;

	protected $fillable = [
		'warna'
	];

	public function barangs()
	{
		return $this->hasMany(\App\Model\Barang::class, 'warna');
	}
}
