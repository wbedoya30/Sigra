<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PensumSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('pensums')->insert([
            [
                'subject_id' => 1,
                'program_id' => 1,
            ],
            [
                'subject_id' => 2,
                'program_id' => 1,
            ],
            [
                'subject_id' => 2,
                'program_id' => 2,
            ],
        ]);
    }
}
