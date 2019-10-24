<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReturDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('retur_detail', function(Blueprint $table)
		{
			$table->foreign('kode_barang', 'retur_detail_ibfk_1')->references('kode_barang')->on('barang')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('no_retur', 'retur_detail_ibfk_2')->references('no_retur')->on('retur')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('retur_detail', function(Blueprint $table)
		{
			$table->dropForeign('retur_detail_ibfk_1');
			$table->dropForeign('retur_detail_ibfk_2');
		});
	}

}
