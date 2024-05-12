<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'verb',
        'taxonomy_bloom_id',
    ];
    //RELACIONES CON OTRAS TABLAS
    public function Taxonomy(){
        return $this->belongsTo(Taxonomy::class);
    }
    public function LearningResult(){
        return $this->hasMany(LearningResult::class);
    }

}
