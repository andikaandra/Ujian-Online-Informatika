<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 50; $i++) { 
            User::create([
                'name' => $faker->name,
                'kode' => '511610005'. $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => bcrypt('secret'),
                'role' => 'mahasiswa',
            ]);
        }

        for ($i=0; $i < 5; $i++) { 
            User::create([
                'name' => $faker->name,
                'kode' => '111111111'. $i,
                'email' => 'dosen' . $i . '@gmail.com',
                'password' => bcrypt('secret'),
                'role' => 'dosen',
            ]);
        }
    }
}
