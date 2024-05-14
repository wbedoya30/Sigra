<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('levels')->insert([
            [
                'verb' => '',
                'taxonomy_level' => 1,
            ],
        ]);
    }
}
