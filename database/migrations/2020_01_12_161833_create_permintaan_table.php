<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermintaanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permintaan', function(Blueprint $table)
		{
			$table->string('kode_permintaan', 20)->primary();
			$table->enum('verifikasi', array('menunggu','ditolak','disetujui'));
			$table->timestamp('tgl')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permintaan');
	}

}
