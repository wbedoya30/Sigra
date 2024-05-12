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
        Schema::create('learning_results', function (Blueprint $table) {
            $table->id();
            $table->text('definition')->nullable();
            $table->bigInteger('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->bigInteger('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');

            $table->unique(['definition','level_id', 'subject_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_results');
    }
};
