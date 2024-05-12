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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();;
            $table->text('duration')->nullable();
            $table->string('awarded_title')->unique()->nullable();
            $table->bigInteger('coordinator_id')->unsigned()->nullable();
            $table->foreign('coordinator_id')->references('id')->on('users');

            $table->unique(['description', 'awarded_title']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
