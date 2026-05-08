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
        Schema::table('evidence', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('uploaded_by');
            $table->unsignedBigInteger('assigned_to')->nullable()->after('status');
            $table->unsignedBigInteger('reviewed_by')->nullable()->after('assigned_to');

            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evidence', function (Blueprint $table) {
            $table->dropForeign(['assigned_to']);
            $table->dropForeign(['reviewed_by']);
            $table->dropColumn(['status', 'assigned_to', 'reviewed_by']);
        });
    }
};
