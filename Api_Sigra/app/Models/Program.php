<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'awarded_title',
        'coordinator_id',

    ];
    //RELACIONES CON OTRAS TABLAS
    public function Coordinator(){
        return $this->belongsTo(User::class);
    }
    public function Pensum(){
        return $this->hasMany(Pensum::class);
    }
    public function GraduateProfile(){
        return $this->hasMany(GraduateProfile::class);
    }
}
