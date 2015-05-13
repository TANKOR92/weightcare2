<?php

use Illuminate\Database\Seeder;
use App\Doctor;
use App\Patient;
use App\Appointment;
use Faker\Factory as Faker;

class AppointmentSeeder extends Seeder 
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		$countdoctor = Doctor::all()->count();
		$countpatient = Patient::all()->count();

		 for($i = 0; $i<5; $i++)
		{
		 	Appointment::create
		 	([
		 		'doctor_id'=> $faker->numberBetween(1,$countdoctor),
		 		'AppDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
		 		'patient_id' => $faker->numberBetween(1,$countpatient)
		 	]);
		}
	}
}