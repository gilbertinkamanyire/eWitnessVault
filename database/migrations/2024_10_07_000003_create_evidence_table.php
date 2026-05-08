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
        Schema::create('evidence', function (Blueprint $table) {
            $table->id();                            // Primary key
            $table->string('title');                 // Evidence title
            $table->text('description')->nullable(); // Evidence description
            $table->string('file_path');             // Storage path
            $table->string('file_hash');             // SHA-256 hash of file
            $table->unsignedBigInteger('uploaded_by'); // Uploader user ID
            $table->timestamps();                    // created_at & updated_at

            // Foreign key constraints
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence');
    }
};
