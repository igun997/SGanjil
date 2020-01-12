<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('barang', function(Blueprint $table)
		{
			$table->foreign('warna', 'barang_ibfk_1')->references('id_warna')->on('warna')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kategori', 'barang_ibfk_2')->references('id_kategori')->on('kategori')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('barang', function(Blueprint $table)
		{
			$table->dropForeign('barang_ibfk_1');
			$table->dropForeign('barang_ibfk_2');
		});
	}

}
