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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable(); // Add surname column
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // Make password nullable
            $table->string('picture')->nullable(); // Add picture column as binary for BLOB
            $table->string('address')->nullable(); // Add address column
            $table->string('phone_number')->nullable(); // Add phone number column
            $table->text('bio')->nullable(); // Add bio column as text for longer content
            $table->rememberToken();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('facebook_id')->nullable()->unique(); // Add Facebook ID column
            $table->string('google_token')->nullable(); // Add Google token column
            $table->string('google_refresh_token')->nullable(); // Add Google refresh token column
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
