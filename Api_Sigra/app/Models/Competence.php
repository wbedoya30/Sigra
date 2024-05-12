<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    //ATRIBUTOS Competence
    protected $fillable = [
        'type',
        'description',
        'capabilities',
        'graduate_profile_id',
    ];
    //RELACIONES CON OTRAS TABLAS

    public function GraduateProfile(){
        return $this->belongsTo(GraduateProfile::class);
    }
}
