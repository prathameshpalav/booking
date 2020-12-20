<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    /**
     * Relationship: show belongs to a movie
     *
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Relationship: show belongs to a theater
     *
     */
    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    /**
     * Mutator: show start time
     *
     */
    public function getStartTimeAttribute($time)
    {
        return date('h:i A', strtotime($time));
    }

    /**
     * Mutator: show date
     *
     */
    public function getShowDateAttribute()
    {
        return date('d M Y', strtotime($this->date));
    }

    /**
     * Mutator: show date time
     *
     */
    public function getShowTimeAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->date . ' ' . $this->start_time));
    }

    /**
     * Fetch shows on same date of a show
     *
     * @param \App\Models\Show $show
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function showsOnSameDate($show)
    {
        return self::where('movie_id', $show->movie_id)
                    ->where('theater_id', $show->theater_id)
                    ->where('date', $show->date)
                    ->get();
    }
}
