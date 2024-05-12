<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('graduate_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('skills');
            // $table->text('knowledge');
            $table->bigInteger('program_id')->unsigned();
            $table->foreign('program_id')->references('id')->on('programs');

            $table->unique(['skills', 'program_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduate_profiles');
    }
};
