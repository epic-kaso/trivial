<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHashcodeToTags extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_file_tags', function(Blueprint $table)
		{
			$table->string('hashcode');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_file_tags', function(Blueprint $table)
		{
			$table->dropColumn('hashcode');
		});
	}

}
