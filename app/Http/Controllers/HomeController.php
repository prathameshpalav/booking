<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Theater;

class HomeController extends Controller
{
    /**
     * Show home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movies = Movie::allMovies();

        return view('welcome', compact('movies'));
    }

    /**
     * Show a specific movie page
     *
     * @param \App\Models\Movie $movie
     * @param string $date
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showMovie(Movie $movie, $date = null)
    {
        $date = empty($date) ? date('Y-m-d') : date('Y-m-d', strtotime($date));

        if(isPastDate($date)) {
            return redirect()->back();
        }

        $theaters = Theater::withAndWhereHas('shows', function($query) use($movie, $date) {
                                $query->where('date', $date)
                                        ->where('movie_id', $movie->id)
                                        ->orderBy('start_time');
                            })->get();
        
        return view('movies.show', compact('movie', 'theaters'));
    }
}
