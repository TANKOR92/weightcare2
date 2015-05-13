<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClinicalrecordMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clinicalrecord', function(Blueprint $table)
		{
			$table->increments('idClinicalRecord');
			$table->float('Weight');
			$table->string('Size');
			$table->float('Muscle');
			$table->float('MetabolicAge');
			$table->integer('patient_id')->unsigned();
			$table->foreign('patient_id')->references('idPatient')->on('patient');
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
		Schema::drop('clinicalrecord');
	}

}
