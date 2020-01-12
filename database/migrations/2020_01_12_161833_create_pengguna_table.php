<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePenggunaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengguna', function(Blueprint $table)
		{
			$table->integer('id_pengguna', true);
			$table->string('username', 20);
			$table->string('password', 100);
			$table->enum('level', array('admin_toko','admin_gudang','kepala_gudang','keuangan'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pengguna');
	}

}
