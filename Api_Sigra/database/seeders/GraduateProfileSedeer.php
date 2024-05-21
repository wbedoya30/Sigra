<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GraduateProfileSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('graduate_profiles')->insert([
            [
                'skills' => '1',
                // 'knowledge' => '',
                'program_id' => 1,
            ],
            [
                'skills' => '2',
                // 'knowledge' => '',
                'program_id' => 2,
            ],
        ]);
    }
}
