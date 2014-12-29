<?php

use Faker\Factory as Faker;

class ProjectTableSeeder extends Seeder {

	public function run() {

		include_once app_path() . '/database/seeds/sr_projects.php';

		$faker = Faker::create();

		foreach ($sr_projects as $proj) {
			Project::create($proj);
		}
	}

}
