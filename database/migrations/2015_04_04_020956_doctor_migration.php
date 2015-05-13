<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DoctorMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctor', function(Blueprint $table)
		{
			$table->increments('idDoctor');
			$table->string('Name');
			$table->string('ProfessionalLicense');
			$table->string('PermanentAddress');
			$table->integer('PhoneNumber');
			$table->string('Mail')->unique();
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
		Schema::drop('doctor');
	}

}
