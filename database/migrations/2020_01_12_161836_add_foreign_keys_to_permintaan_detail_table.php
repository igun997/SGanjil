<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPermintaanDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('permintaan_detail', function(Blueprint $table)
		{
			$table->foreign('kode_barang', 'permintaan_detail_ibfk_1')->references('kode_barang')->on('barang')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kode_permintaan', 'permintaan_detail_ibfk_2')->references('kode_permintaan')->on('permintaan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('permintaan_detail', function(Blueprint $table)
		{
			$table->dropForeign('permintaan_detail_ibfk_1');
			$table->dropForeign('permintaan_detail_ibfk_2');
		});
	}

}
