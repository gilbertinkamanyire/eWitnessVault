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
            $table->id();                        // Primary key
            $table->string('name');              // Full name
            $table->string('email')->unique();   // Email for login
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');          // Hashed password
            $table->string('phone')->nullable(); // Optional contact
            $table->string('avatar')->nullable(); // Optional profile picture
            $table->rememberToken();             // Remember me token
            $table->timestamps();                // created_at & updated_at
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
