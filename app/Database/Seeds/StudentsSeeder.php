<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class StudentsSeeder extends Seeder
{
    public function run()
    {
        $buildeer = $this->db->table("students");
        for ($i = 0; $i < 10; $i++) {
            $buildeer->insert($this->generate());
        }
    }
    public function generate(){
        $faker = Factory::create();
        return [
            'name'=>$faker->name,
            'age'=>$faker->age
        ];
    }
}
