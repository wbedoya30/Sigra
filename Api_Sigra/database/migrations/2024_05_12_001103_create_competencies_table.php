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
        Schema::create('competencies', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['general', 'especifica'])->default('general');
            $table->text('description')->nullable();
            // $table->text('capabilities');
            $table->bigInteger('graduate_profile_id')->unsigned();
            $table->foreign('graduate_profile_id')->references('id')->on('graduate_profiles');

            $table->unique(['type', 'description','graduate_profile_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencies');
    }
};
