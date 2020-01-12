<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHistoryHargaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('history_harga', function(Blueprint $table)
		{
			$table->foreign('kode_barang', 'history_harga_ibfk_1')->references('kode_barang')->on('barang')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('history_harga', function(Blueprint $table)
		{
			$table->dropForeign('history_harga_ibfk_1');
		});
	}

}
