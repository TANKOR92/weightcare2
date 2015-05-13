<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppointmentMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointment', function(Blueprint $table)
		{
			$table->increments('idAppointment');
			$table->string('AppDate');
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
		Schema::drop('appointment');
	}

}
