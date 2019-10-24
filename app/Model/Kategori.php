<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jul 2019 21:16:42 +0000.
 */

namespace App\Model;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Kategori
 * 
 * @property int $id_kategori
 * @property string $kategori
 * @property string $ket
 * 
 * @property \Illuminate\Database\Eloquent\Collection $barangs
 *
 * @package App\Model
 */
class Kategori extends Eloquent
{
	protected $table = 'kategori';
	protected $primaryKey = 'id_kategori';
	public $timestamps = false;

	protected $fillable = [
		'kategori',
		'ket'
	];

	public function barangs()
	{
		return $this->hasMany(\App\Model\Barang::class, 'kategori');
	}
}
