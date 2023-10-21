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
        Schema::create('move_pokemon', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pokemon_id');

            $table->foreign('pokemon_id')->references('id')->on('pokemon');

            $table->unsignedBigInteger('move_id');

            $table->foreign('move_id')->references('id')->on('moves');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_moves');
    }
};
