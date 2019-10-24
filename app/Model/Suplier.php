<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jul 2019 21:16:56 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Suplier
 * 
 * @property int $id_suplier
 * @property string $nama_suplier
 * @property string $alamat
 * @property string $no_hp
 * @property string $ket
 * 
 * @property \Illuminate\Database\Eloquent\Collection $pos
 *
 * @package App\Model
 */
class Suplier extends Eloquent
{
	protected $table = 'suplier';
	protected $primaryKey = 'id_suplier';
	public $timestamps = false;

	protected $fillable = [
		'nama_suplier',
		'alamat',
		'no_hp',
		'ket'
	];

	public function pos()
	{
		return $this->hasMany(\App\Model\Po::class, 'id_suplier');
	}
}
