<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spectacle extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','total_seats','state','date'];
    
    public function seats()
    {
        return $this->hasMany(Seat::class, 'id_spectacle', 'id_spectacle');
    }
}
