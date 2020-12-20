<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([            
            'name'          => 'Andheri',                
            'created_by'    => 1,
            'updated_by'    => 1
        ]);

        Location::create([            
            'name'          => 'Malad',
            'created_by'    => 1,
            'updated_by'    => 1
        ]);
    }
}
