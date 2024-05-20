<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('programs')->insert([
            [
                'name' => 'Administración de Empresas',
                'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                'duration' => 'La duración del Programa jornada diurna es de 10 semestres y jornada nocturna es de 11 semestres. ',
                'awarded_title' => 'Administrador (a) de Empresas ',
                'image'=> '',
                // 'coordinator_id' => 1,

            ],
            [
                'name' => 'Tecnología en Desarrollo de Software.',
                'description' => 'Formar profesionales en Tecnología en Desarrollo de Software capaces de dar soluciones a problemas reales mediante el desarrollo de software, el diseño de interacciones humano-computador o la gestión de infraestructura TIC.',
                'duration' => '7 semestres(N); 6 semestres (D)',
                'awarded_title' => 'Tecnólogo en desarrollo de software.',
                'image'=> '',
                // 'coordinator_id' => 1,

            ],
            [
                'name' => 'Trabajo Social',
                'description' => 'El Trabajo Social es una disciplina profesión con presencia mundial y con tendencias de formación diversas de acuerdo a las características de los contextos.',
                'duration' => 'Diez (10) semestres (D)',
                'awarded_title' => 'Trabajador Social',
                'image'=> '',
                // 'coordinator_id' => 1,

            ],
        ]);
    }
}
