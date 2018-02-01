<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegenciesTable extends Migration {

	public function up()
	{
		Schema::create('regencies', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('province_id')->unsigned()->nullable()->index();
			$table->string('name', 191)->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('regencies');
	}
}