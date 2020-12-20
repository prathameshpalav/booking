<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    /**
     * Relationship: theater has many shows
     *
     */
    public function shows()
    {
        return $this->hasMany(Show::class);
    }

    /**
     * Scope query for with and whereHas
     *
     */
    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
