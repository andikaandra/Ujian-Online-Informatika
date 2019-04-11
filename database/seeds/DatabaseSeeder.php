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
		for ($i=0; $i < 10; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->freeEmail,
                'kode' => '05111640000'.$i,
                'password' => bcrypt('secret'),
                'role' => 'mahasiswa',
            ]);
        }

    }
}
