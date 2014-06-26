<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SorsTableSeeder extends Seeder {


    public function run()
    {

        include_once(app_path() . '/database/seeds/sr_sors.php');

        $faker = Faker::create();

        foreach($sr_sors as $sor) {
            Sor::create($sor);
        }
    }

}