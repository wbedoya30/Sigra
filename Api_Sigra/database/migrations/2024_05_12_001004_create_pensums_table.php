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
        Schema::create('pensums', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->bigInteger('program_id')->unsigned();
            $table->foreign('program_id')->references('id')->on('programs');

            $table->unique(['subject_id', 'program_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pensums');
    }
};
