<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoryHargaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('history_harga', function(Blueprint $table)
		{
			$table->integer('id_hg', true);
			$table->integer('harga');
			$table->string('kode_barang', 7)->index('kd_barang');
			$table->string('bukti', 60);
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
		Schema::drop('history_harga');
	}

}
