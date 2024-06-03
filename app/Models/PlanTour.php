<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanTour extends Model
{
    use HasFactory;

    public function tour(){
        return $this->belongsTo(Tour::class);
    }

    public function books(){
        return $this->hasMany(Book::class);
    }
}
