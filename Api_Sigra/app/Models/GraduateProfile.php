<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduateProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'skills',
        'knowledge',
        'program_id',
    ];
    //RELACIONES CON OTRAS TABLAS
    public function Program(){
        return $this->belongsTo(Program::class);
    }
    public function Competencie(){
        return $this->hasMany(Competencie::class);
    }
}
