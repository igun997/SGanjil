<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('po', function(Blueprint $table)
		{
			$table->string('no_po', 20)->primary();
			$table->integer('id_suplier')->index('id_suplier');
			$table->enum('status', array('diproses','selesai'));
			$table->enum('status_keuangan', array('unconfirm','confirmed'));
			$table->enum('validasi', array('menunggu','ditolak','disetujui'));
			$table->text('ket', 65535)->nullable();
			$table->timestamp('tgl_po')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('po');
	}

}
