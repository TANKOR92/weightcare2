<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatientMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient', function(Blueprint $table)
		{
			$table->increments('idPatient');
			$table->string('Name');
			$table->string('PermanentAddress');
			$table->integer('PhoneNumber');
			$table->string('Mail')->unique();
			$table->float('Age')->unsigned;
			$table->integer('doctor_id')->unsigned();
			$table->foreign('doctor_id')->references('idDoctor')->on('doctor');
			$table->rememberToken();
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
		Schema::drop('patient');
	}

}
