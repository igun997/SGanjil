<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 07 Jul 2019 15:26:31 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ReturDetail
 * 
 * @property int $id_retur_detail
 * @property string $no_retur
 * @property string $kode_barang
 * @property float $total_retur
 * 
 * @property \App\Model\Barang $barang
 * @property \App\Model\Retur $retur
 *
 * @package App\Model
 */
class ReturDetail extends Eloquent
{
	protected $table = 'retur_detail';
	protected $primaryKey = 'id_retur_detail';
	public $timestamps = false;

	protected $casts = [
		'total_retur' => 'float'
	];

	protected $fillable = [
		'no_retur',
		'kode_barang',
		'total_retur'
	];

	public function barang()
	{
		return $this->belongsTo(\App\Model\Barang::class, 'kode_barang');
	}

	public function retur()
	{
		return $this->belongsTo(\App\Model\Retur::class, 'no_retur');
	}
}
