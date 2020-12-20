<?php

namespace Database\Seeders;

use App\Models\Location;
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
        $this->call(UserSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(TheaterSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(ShowSeeder::class);
    }
}
