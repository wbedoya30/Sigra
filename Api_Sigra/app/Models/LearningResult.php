<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'definition',
        'subject_id',
        'level_id',
    ];
    //RELACIONES CON OTRAS TABLAS
    public function Subject(){
        return $this->belongsTo(Subject::class);
    }
    public function Level(){
        return $this->belongsTo(Level::class);
    }
}
