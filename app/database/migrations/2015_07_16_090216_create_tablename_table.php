<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablenameTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logbooks', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->integer('priorities_id');
            $table->timestamps();
        });

		Schema::create('reports', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('server');
            $table->integer('room_temp');
            $table->timestamps();
        });

        Schema::create('priorities', function(Blueprint $table) {
            $table->increments('id');
            $table->string('description');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logbooks');
		Schema::drop('reports');	
		Schema::drop('lbstats');	
		Schema::drop('priorities');		
	}

}
