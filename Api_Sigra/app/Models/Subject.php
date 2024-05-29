<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'credits',
        'description',
        'status',
    ];
    //RELACIONES CON OTRAS TABLAS
    public function Pensum(){
        return $this->hasMany(Pensum::class);
    }
    public function LearningResult(){
        return $this->hasMany(LearningResult::class);
    }

    public function Program()
    {
        return $this->belongsToMany(Program::class, 'pensums');
    }
}
