<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 22 Oct 2019 18:29:46 +0700.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class HistoryHarga
 *
 * @property int $id_hg
 * @property int $harga
 * @property string $kode_barang
 * @property \Carbon\Carbon $tgl_buat
 *
 * @property \App\Model\Barang $barang
 *
 * @package App\Model
 */
class HistoryHarga extends Eloquent
{
	protected $table = 'history_harga';
	protected $primaryKey = 'id_hg';
	public $timestamps = false;

	protected $casts = [
		'harga' => 'int'
	];


	protected $fillable = [
		'harga',
		'bukti',
		'kode_barang'
	];

	public function barang()
	{
		return $this->belongsTo(\App\Model\Barang::class, 'kode_barang');
	}
}
