<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 06 Jul 2019 07:20:50 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Barang
 *
 * @property string $kode_barang
 * @property string $nama_barang
 * @property int $warna
 * @property int $kategori
 * @property float $jumlah
 * @property float $harga_satuan
 * @property float $stok_awal
 *
 * @property \Illuminate\Database\Eloquent\Collection $po_details
 * @property \Illuminate\Database\Eloquent\Collection $retur_details
 *
 * @package App\Model
 */
class Barang extends Eloquent
{
	protected $table = 'barang';
	protected $primaryKey = 'kode_barang';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'warna' => 'int',
		'kategori' => 'int',
		'harga_satuan' => 'float',
		'stok_awal' => 'float'
	];

	protected $fillable = [
		'kode_barang',
		'nama_barang',
		'warna',
		'kategori',
		'harga_satuan',
		'stok_minimum',
		'stok_awal'
	];

	public function warna_content()
	{
		return $this->belongsTo(\App\Model\Warna::class, 'warna');
	}

	public function kategori_content()
	{
		return $this->belongsTo(\App\Model\Kategori::class, 'kategori');
	}

	public function po_details()
	{
		return $this->hasMany(\App\Model\PoDetail::class, 'kode_barang');
	}
	public function history()
	{
		return $this->hasMany(\App\Model\HistoryHarga::class, 'kode_barang');
	}

	public function retur_details()
	{
		return $this->hasMany(\App\Model\ReturDetail::class, 'kode_barang');
	}
}
