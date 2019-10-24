<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 20:08:33 +0700.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PoDetail
 *
 * @property int $id_po_detail
 * @property string $no_po
 * @property string $kode_barang
 * @property float $total_pesan
 * @property float $total_terima
 *
 * @property \App\Model\Barang $barang
 * @property \App\Model\Po $po
 * @property \Illuminate\Database\Eloquent\Collection $po_terimas
 *
 * @package App\Model
 */
class PoDetail extends Eloquent
{
	protected $table = 'po_detail';
	protected $primaryKey = 'id_po_detail';
	public $timestamps = false;

	protected $casts = [
		'total_pesan' => 'float',
		'total_terima' => 'float'
	];

	protected $fillable = [
		'no_po',
		'kode_barang',
		'harga',
		'bukti',
		'total_pesan',
		'total_terima'
	];

	public function barang()
	{
		return $this->belongsTo(\App\Model\Barang::class, 'kode_barang');
	}

	public function po()
	{
		return $this->belongsTo(\App\Model\Po::class, 'no_po');
	}

	public function po_terimas()
	{
		return $this->hasMany(\App\Model\PoTerima::class, 'id_po_detail');
	}
}
