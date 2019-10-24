<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jul 2019 21:13:42 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Retur
 *
 * @property string $no_retur
 * @property string $no_po
 * @property string $status
 * @property string $status_keuangan
 * @property \Carbon\Carbon $tanggal_retur
 *
 * @property \App\Model\Po $po
 * @property \Illuminate\Database\Eloquent\Collection $retur_details
 *
 * @package App\Model
 */
class Retur extends Eloquent
{
	protected $table = 'retur';
	protected $primaryKey = 'no_retur';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'tanggal_retur'
	];

	protected $fillable = [
		'no_retur',
		'no_po',
		'status',
		'status_keuangan',
		'tanggal_retur'
	];

	public function po()
	{
		return $this->belongsTo(\App\Model\Po::class, 'no_po');
	}

	public function retur_details()
	{
		return $this->hasMany(\App\Model\ReturDetail::class, 'no_retur');
	}
}
