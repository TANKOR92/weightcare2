<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DietMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('diet', function(Blueprint $table)
		{
			$table->increments('idDiet');
			$table->string('RecipeDate');
			$table->integer('doctor_id')->unsigned();
			$table->foreign('doctor_id')->references('idDoctor')->on('doctor');
			$table->integer('patient_id')->unsigned();
			$table->foreign('patient_id')->references('idPatient')->on('patient');
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
		Schema::drop('diet');
	}

}
