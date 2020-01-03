<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('po', function(Blueprint $table)
		{
			$table->foreign('id_suplier', 'po_ibfk_1')->references('id_suplier')->on('suplier')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('po', function(Blueprint $table)
		{
			$table->dropForeign('po_ibfk_1');
		});
	}

}
