<?php

use Illuminate\Database\Seeder;
use App\Doctor;
use App\Patient;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder 
{
	public function run()
	{
		$faker = Faker::create();

		$cantidad = Doctor::all()->count();

		for($i = 0; $i < 10; $i++)
		{
		 	Patient::create
		 	([
		 		'Name' => $faker->name(),
		 		'PermanentAddress' => $faker->address(),
		 		'PhoneNumber' => $faker->randomNumber(7),
		 		'Mail' => $faker->freeEmail(),
		 		'Age' => $faker->numberBetween(20,30),
		 		'doctor_id' => $faker->numberBetween(1,$cantidad),
		 	]);
		}
	}
}