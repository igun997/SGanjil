<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 07 Jul 2019 10:17:44 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PermintaanDetail
 * 
 * @property int $id_permintaan_detail
 * @property string $kode_permintaan
 * @property string $kode_barang
 * @property float $jumlah
 * 
 * @property \App\Model\Barang $barang
 * @property \App\Model\Permintan $permintan
 *
 * @package App\Model
 */
class PermintaanDetail extends Eloquent
{
	protected $table = 'permintaan_detail';
	protected $primaryKey = 'id_permintaan_detail';
	public $timestamps = false;

	protected $casts = [
		'jumlah' => 'float'
	];

	protected $fillable = [
		'kode_permintaan',
		'kode_barang',
		'jumlah'
	];

	public function barang()
	{
		return $this->belongsTo(\App\Model\Barang::class, 'kode_barang');
	}

	public function permintan()
	{
		return $this->belongsTo(\App\Model\Permintaan::class, 'kode_permintaan');
	}
}
