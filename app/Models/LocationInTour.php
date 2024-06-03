<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationInTour extends Model
{
    use HasFactory;

    public function tour(){
        return $this->belongsTo(Tour::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }
}
