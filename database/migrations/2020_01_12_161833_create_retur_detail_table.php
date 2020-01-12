<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReturDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('retur_detail', function(Blueprint $table)
		{
			$table->integer('id_retur_detail', true);
			$table->string('no_retur', 20)->index('np');
			$table->string('kode_barang', 7)->index('k_b');
			$table->float('total_retur', 10, 0);
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
		Schema::drop('retur_detail');
	}

}
