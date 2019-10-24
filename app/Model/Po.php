<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jul 2019 21:13:18 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Po
 *
 * @property string $no_po
 * @property int $id_suplier
 * @property string $status
 * @property string $status_keuangan
 * @property string $validasi
 * @property string $ket
 * @property \Carbon\Carbon $tgl_po
 *
 * @property \App\Model\Suplier $suplier
 * @property \Illuminate\Database\Eloquent\Collection $po_details
 * @property \Illuminate\Database\Eloquent\Collection $returs
 *
 * @package App\Model
 */
class Po extends Eloquent
{
	protected $table = 'po';
	protected $primaryKey = 'no_po';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_suplier' => 'int'
	];

	protected $dates = [
		'tgl_po'
	];

	protected $fillable = [
		'no_po',
		'id_suplier',
		'status',
		'status_keuangan',
		'validasi',
		'ket',
		'tgl_po'
	];

	public function suplier()
	{
		return $this->belongsTo(\App\Model\Suplier::class, 'id_suplier');
	}

	public function po_details()
	{
		return $this->hasMany(\App\Model\PoDetail::class, 'no_po');
	}

	public function returs()
	{
		return $this->hasMany(\App\Model\Retur::class, 'no_po');
	}
}
