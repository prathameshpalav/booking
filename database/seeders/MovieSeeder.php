<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create([            
            'name'                      => 'Avengers: Endgame', 
            'slug'                      => 'avengers-endgame',
            'description'               => 'The grave course of events set in motion by Thanos that wiped out half the universe and fractured the Avengers ranks compels the remaining Avengers to take one final stand in Marvel Studios` grand conclusion to twenty-two films, "Avengers: Endgame."',                
            'release_date'              => '2020-10-12',    
            'ratings'                   => 5,   
            'image_url'                 => 'https://in.bmscdn.com/iedb/movies/images/mobile/thumbnail/xlarge/avengers-end-game-et00090482-07-12-2018-06-50-21.jpg', 
            'running_time_in_minutes'   => 182,               
            'created_by'                => 1,
            'updated_by'                => 1
        ]);

        Movie::create([            
            'name'                      => 'Wonder Woman 1984',
            'slug'                      => 'wonder-women-1984',
            'description'               => 'Set in the United States during the 1980s, a conflict arises between Diana Prince and the Soviet Union. Now, she must face her formidable foe, Barbara Ann Minerva.',                
            'release_date'              => '2020-11-12',    
            'ratings'                   => 4, 
            'image_url'                 => 'https://in.bmscdn.com/iedb/movies/images/mobile/thumbnail/xlarge/wonder-woman-1984-et00077622-04-12-2020-12-31-26.jpg',   
            'running_time_in_minutes'   => 150,               
            'created_by'                => 1,
            'updated_by'                => 1
        ]);
    }
}
