<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoTerimaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('po_terima', function(Blueprint $table)
		{
			$table->integer('id_po_terima', true);
			$table->string('no_po', 20)->index('no_po');
			$table->integer('id_po_detail')->index('id_detail');
			$table->integer('total_terima');
			$table->timestamp('tgl_terima')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('po_terima');
	}

}
