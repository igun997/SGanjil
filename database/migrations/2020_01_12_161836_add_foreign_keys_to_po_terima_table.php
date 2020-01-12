<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPoTerimaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('po_terima', function(Blueprint $table)
		{
			$table->foreign('id_po_detail', 'po_terima_ibfk_1')->references('id_po_detail')->on('po_detail')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('no_po', 'po_terima_ibfk_2')->references('no_po')->on('po')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('po_terima', function(Blueprint $table)
		{
			$table->dropForeign('po_terima_ibfk_1');
			$table->dropForeign('po_terima_ibfk_2');
		});
	}

}
