<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuplierTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suplier', function(Blueprint $table)
		{
			$table->integer('id_suplier', true);
			$table->string('nama_suplier', 69);
			$table->text('alamat', 65535);
			$table->string('no_hp', 20)->nullable();
			$table->text('ket', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('suplier');
	}

}
