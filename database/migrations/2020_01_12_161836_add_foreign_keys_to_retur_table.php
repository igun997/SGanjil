<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReturTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('retur', function(Blueprint $table)
		{
			$table->foreign('no_po', 'retur_ibfk_1')->references('no_po')->on('po')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('retur', function(Blueprint $table)
		{
			$table->dropForeign('retur_ibfk_1');
		});
	}

}
