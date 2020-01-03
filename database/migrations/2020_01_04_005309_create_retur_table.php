<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReturTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('retur', function(Blueprint $table)
		{
			$table->string('no_retur', 20)->primary();
			$table->string('no_po', 20)->index('no_po');
			$table->enum('status', array('diproses','selesai'));
			$table->enum('status_keuangan', array('unconfirm','confirmed'));
			$table->timestamp('tanggal_retur')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('retur');
	}

}
