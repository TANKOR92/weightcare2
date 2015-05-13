<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 $this->call('DoctorSeeder');
		 $this->call('PatientSeeder');
		 $this->call('DietSeeder');
		 $this->call('RecipeSeeder');
		 $this->call('AppointmentSeeder');
		 $this->call('ClinicalRecordSeeder');
		 User::truncate();
		 $this->call('UserSeeder');
	}

}
