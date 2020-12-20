<?php

namespace Database\Seeders;

use App\Models\Show;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();
        
        // theater 1
        Show::create([            
            'movie_id'                  => 1,
            'theater_id'                => 1,
            'date'                      => $current_date,    
            'start_time'                => '09:00:00',    
            'amount_per_person'         => 150,               
            'created_by'                => 1,
            'updated_by'                => 1
        ]);

        Show::create([            
            'movie_id'                  => 2,
            'theater_id'                => 1,
            'date'                      => $current_date,    
            'start_time'                => '12:00:00',    
            'amount_per_person'         => 200,               
            'created_by'                => 1,
            'updated_by'                => 1
        ]);

        Show::create([            
            'movie_id'                  => 1,
            'theater_id'                => 1,
            'date'                      => $current_date,    
            'start_time'                => '15:00:00',    
            'amount_per_person'         => 150,               
            'created_by'                => 1,
            'updated_by'                => 1
        ]);

        Show::create([            
            'movie_id'                  => 2,
            'theater_id'                => 1,
            'date'                      => $current_date,    
            'start_time'                => '21:00:00',    
            'amount_per_person'         => 200,               
            'created_by'                => 1,
            'updated_by'                => 1
        ]);

        // theater 2
        Show::create([            
            'movie_id'                  => 1,
            'theater_id'                => 2,
            'date'                      => $current_date,    
            'start_time'                => '13:00:00',    
            'amount_per_person'         => 150,               
            'created_by'                => 1,
            'updated_by'                => 1
        ]);

        Show::create([            
            'movie_id'                  => 2,
            'theater_id'                => 2,
            'date'                      => $current_date,    
            'start_time'                => '15:30:00',    
            'amount_per_person'         => 200,               
            'created_by'                => 1,
            'updated_by'                => 1
        ]);
    }
}
