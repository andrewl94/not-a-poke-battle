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
        Schema::create('battles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("player_pokemon_id");

            $table->unsignedBigInteger("npc_pokemon_id");

            $table->foreign('player_pokemon_id')->references('id')->on('pokemon');

            $table->foreign('npc_pokemon_id')->references('id')->on('pokemon');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battle');
    }
};
