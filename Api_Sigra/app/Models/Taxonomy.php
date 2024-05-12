<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    use HasFactory;

    protected $fillable = [
        'bloom_level',
    ];
    //RELACIONES CON OTRAS TABLAS
    public function Level(){
        return $this->hasMany(Level::class);
    }
}
