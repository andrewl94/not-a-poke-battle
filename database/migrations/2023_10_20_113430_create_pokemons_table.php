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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->unsignedSmallInteger('current_hp');

            $table->unsignedSmallInteger('hp');

            $table->unsignedSmallInteger('attack');

            $table->unsignedSmallInteger('defense');

            $table->unsignedSmallInteger('speed');

            $table->unsignedSmallInteger('special_attack');

            $table->unsignedSmallInteger('special_defense');

            $table->json('types');

            $table->string('sprite');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemons');
    }
};
