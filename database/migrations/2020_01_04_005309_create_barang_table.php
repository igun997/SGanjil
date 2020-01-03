<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barang', function(Blueprint $table)
		{
			$table->string('kode_barang', 7)->primary();
			$table->string('nama_barang', 100);
			$table->integer('warna')->index('const_warna');
			$table->float('stok_minimum', 10, 0);
			$table->integer('kategori')->index('const_kategori');
			$table->float('harga_satuan', 10, 0);
			$table->float('stok_awal', 10, 0);
			$table->timestamp('tgl_buat')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('barang');
	}

}
