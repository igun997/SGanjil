<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermintaanDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permintaan_detail', function(Blueprint $table)
		{
			$table->integer('id_permintaan_detail', true);
			$table->string('kode_permintaan', 20)->index('x_p');
			$table->string('kode_barang', 7)->index('x_kode');
			$table->float('jumlah', 10, 0);
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
		Schema::drop('permintaan_detail');
	}

}
