<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 11:52:29 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permintaan
 *
 * @property string $kode_permintaan
 * @property string $verifikasi
 * @property \Carbon\Carbon $tgl
 * @property string $ket
 *
 * @property \Illuminate\Database\Eloquent\Collection $permintaan_details
 *
 * @package App\Model
 */
class Permintaan extends Eloquent
{
	protected $table = 'permintaan';
	protected $primaryKey = 'kode_permintaan';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'tgl'
	];

	protected $fillable = [
		'kode_permintaan',
		'verifikasi',
		'tgl',
		'ket'
	];

	public function permintaan_details()
	{
		return $this->hasMany(\App\Model\PermintaanDetail::class, 'kode_permintaan');
	}
}
