<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvincesTable extends Migration {

	public function up()
	{
		Schema::create('provinces', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 191)->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('provinces');
	}
}