<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 20:40:49 +0700.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PoTerima
 * 
 * @property int $id_po_terima
 * @property string $no_po
 * @property int $id_po_detail
 * @property int $total_terima
 * @property \Carbon\Carbon $tgl_terima
 * 
 * @property \App\Model\PoDetail $po_detail
 * @property \App\Model\Po $po
 *
 * @package App\Model
 */
class PoTerima extends Eloquent
{
	protected $table = 'po_terima';
	protected $primaryKey = 'id_po_terima';
	public $timestamps = false;

	protected $casts = [
		'id_po_detail' => 'int',
		'total_terima' => 'int'
	];

	protected $dates = [
		'tgl_terima'
	];

	protected $fillable = [
		'no_po',
		'id_po_detail',
		'total_terima',
		'tgl_terima'
	];

	public function po_detail()
	{
		return $this->belongsTo(\App\Model\PoDetail::class, 'id_po_detail');
	}

	public function po()
	{
		return $this->belongsTo(\App\Model\Po::class, 'no_po');
	}
}
