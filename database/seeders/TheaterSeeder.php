<?php

namespace Database\Seeders;

use App\Models\Theater;
use Illuminate\Database\Seeder;

class TheaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theater::create([            
            'name'          => 'Cinepolis: Fun Republic Mall, Andheri (W)', 
            'address'       => 'Plot No.844/4,Level 4, Shah Industrial Estate, Veera Desai Road, Andheri(West), Near ICICI Bank ATM, Mumbai, Maharashtra 400053, India',
            'location_id'   => 1,   
            'seats'         => 30,            
            'created_by'    => 1,
            'updated_by'    => 1
        ]);

        Theater::create([            
            'name'          => 'PVR ICON: Infiniti Andheri (W)', 
            'address'       => 'Infinity Mall, New Link Road, Opposite Crystal Plaza, Next To Citi Mall, Andheri (W), Near Lotus Petrol Pump, Mumbai, Maharashtra 400053, India',
            'location_id'   => 1,
            'seats'         => 30,               
            'created_by'    => 1,
            'updated_by'    => 1
        ]);

        Theater::create([            
            'name'          => 'INOX: Megaplex, Inorbit Mall, Malad', 
            'address'       => 'Inorbit Mall, Goregaon Malad Link Road, Near Shoppers Stop, Malad West, Mumbai, Maharashtra 400064, India',
            'location_id'   => 2,               
            'created_by'    => 1,
            'updated_by'    => 1
        ]);

        Theater::create([            
            'name'          => 'Cinemax: Infiniti Mall, Malad (W)', 
            'address'       => 'Survey No 504, Link Road, Malad (W), Near D-Mart, Mumbai, Maharashtra 400065, India',
            'location_id'   => 2,               
            'created_by'    => 1,
            'updated_by'    => 1
        ]);
    }
}
