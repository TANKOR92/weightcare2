<?php

use Illuminate\Database\Seeder;
use App\Doctor;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder 
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		 for($i = 0; $i<3; $i++)
		{
		 	Doctor::create
		 	([
		 		'ProfessionalLicense' => $faker->creditCardNumber(),
		 		'Name' => $faker->name(),
		 		'PermanentAddress'=> $faker->address(),
		 		'PhoneNumber' => $faker->randomNumber(7),
		 		'Mail' => $faker->companyEmail
		 	]);
		}
	}
}