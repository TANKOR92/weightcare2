<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder 
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		 	User::create
		 	([
		 		'email' => 'prueba@prueba.com',
		 		'password' => Hash::make('prueba')
		 	]);
	}
}