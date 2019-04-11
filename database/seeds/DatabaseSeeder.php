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
		for ($i=1; $i <= 180; $i++) {
            $user = User::create([
                'kode' => '05111640000'.sprintf('%03u', $i),
                'password' => bcrypt('secret'),
                'role' => 'mahasiswa',
            ]);
        }

        for ($i=1; $i <= 10; $i++) {
            $user = User::create([
                'kode' => '194710251978031'.sprintf('%03u', $i),
                'password' => bcrypt('secret'),
                'role' => 'dosen',
            ]);
        }
    }
}
