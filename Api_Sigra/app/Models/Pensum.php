<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pensum extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'program_id',
    ];
    //RELACIONES CON OTRAS TABLAS
    public function Subject(){
        return $this->belongsTo(Subject::class);
    }
    public function Program(){
        return $this->belongsTo(Program::class);
    }
}
