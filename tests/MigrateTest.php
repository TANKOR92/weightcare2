<?php
class MigrateTest extends TestCase{

	public function setUp(){
		parent::setUp();
		Artisan::call('migrate:refresh');
		$this->seed('DatabaseSeeder');

	}

	public function testDummyToEnsureSeTupRun(){
		$this->assertTrue(true);
	}
}