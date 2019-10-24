<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPoDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('po_detail', function(Blueprint $table)
		{
			$table->foreign('kode_barang', 'po_detail_ibfk_1')->references('kode_barang')->on('barang')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('no_po', 'po_detail_ibfk_2')->references('no_po')->on('po')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('po_detail', function(Blueprint $table)
		{
			$table->dropForeign('po_detail_ibfk_1');
			$table->dropForeign('po_detail_ibfk_2');
		});
	}

}
