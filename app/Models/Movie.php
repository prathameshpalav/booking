<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relationship: movie has many shows
     *
     */
    public function shows()
    {
        return $this->hasMany(Show::class);
    }
    
    /**
     * Mutator: release date
     *
     */
    public function getReleaseDateAttribute($date)
    {        
        return date('M d Y', strtotime($date));
    }

    /**
     * Fetch all movies and order by release date
     *
     * @static
     * @param \App\Models\Show $show
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function allMovies()
    {
        return self::orderBy('release_date', 'desc')->get();
    }
}
