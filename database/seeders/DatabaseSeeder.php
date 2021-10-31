<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Komponen::factory(10)->create();
        $this->call([
            UserSeeder::class,
            KomponenSeeder::class,
            PerawatanSeeder::class,
            PerbaikanSeeder::class,
            GangguanSeeder::class,
            TerasSeeder::class,
        ]);
    }
}
