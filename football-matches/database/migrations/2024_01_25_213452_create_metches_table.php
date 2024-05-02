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
        Schema::create('metches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_team_id')->nullable();
            $table->foreignId('guest_team_id')->nullable();
            $table->string('result')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->foreign('home_team_id')->references('id')->on('teams')->nullable();
            $table->foreign('guest_team_id')->references('id')->on('teams')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metches');
    }
};
