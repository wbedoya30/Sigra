<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;
use Illuminate\Support\Str; // Add this line to import the Str class

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        DB::table('pensums')->delete();
        DB::table('learning_results')->delete();
        DB::table('levels')->delete();
        DB::table('taxonomys')->delete();
        DB::table('subjects')->delete();
        DB::table('graduate_profiles')->delete();
        DB::table('competencies')->delete();
        DB::table('programs')->delete();
        DB::table('users')->delete();

        $this->call(UserSedeer::class);
        $this->call(SubjectSedeer::class);
        $this->call(ProgramSedeer::class);
        $this->call(TaxonomySedeer::class);
        $this->call(LevelSedeer::class);
        $this->call(PensumSedeer::class);
        $this->call(LearningResultSedeer::class);
        $this->call(GraduateProfileSedeer::class);
        $this->call(CompetenceSedeer::class);
    }
}
