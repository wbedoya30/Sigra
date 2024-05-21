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
                'description' => '11111111111111111111111',
                // 'capabilities' => '',
                'graduate_profile_id' => 1,
            ],
            [
                'type' => 2,
                'description' => '2222222222222222',
                // 'capabilities' => '',
                'graduate_profile_id' => 2,
            ],
            [
                'type' => 2,
                'description' => '333333333333333333',
                // 'capabilities' => '',
                'graduate_profile_id' => 2,
            ],
        ]);
    }
}
