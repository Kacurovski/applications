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
        Schema::create('metch_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->nullable();
            $table->foreignId('metch_id')->nullable();
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players')->nullable();
            $table->foreign('metch_id')->references('id')->on('metches')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metch_player');
    }
};
