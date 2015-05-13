<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecipeMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipe', function(Blueprint $table)
		{
			$table->increments('idRecipe');
			$table->string('Ingredients');
			$table->string('Image');
			$table->string('Description');
			$table->float('Calories');
			$table->integer('diet_id')->unsigned();
			$table->foreign('diet_id')->references('idDiet')->on('diet');
			$table->integer('doctor_id')->unsigned();
			$table->foreign('doctor_id')->references('idDoctor')->on('doctor');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recipe');
	}

}
