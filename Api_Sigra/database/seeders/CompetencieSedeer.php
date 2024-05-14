<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetencieSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('competencies')->insert([
            [
                'type' => 1,
                'description' => '',
                // 'capabilities' => '',
                'graduate_profile_id' => 1,
            ],
        ]);
    }
}
