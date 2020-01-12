<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('po_detail', function(Blueprint $table)
		{
			$table->integer('id_po_detail', true);
			$table->string('no_po', 20)->index('po_no');
			$table->string('kode_barang', 7)->index('k_b');
			$table->float('total_pesan', 10, 0);
			$table->float('total_terima', 10, 0)->default(0);
			$table->float('harga', 10, 0)->nullable();
			$table->string('bukti', 100)->nullable();
			$table->integer('persetujuan_harga')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('po_detail');
	}

}
