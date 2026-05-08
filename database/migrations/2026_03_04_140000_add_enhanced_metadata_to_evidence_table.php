<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add enhanced metadata fields for full hybrid app support:
     * altitude, GPS accuracy, device info, file size, MIME type,
     * and a JSON metadata column for extensible data storage.
     */
    public function up(): void
    {
        Schema::table('evidence', function (Blueprint $table) {
            if (!Schema::hasColumn('evidence', 'altitude')) {
                $table->decimal('altitude', 10, 2)->nullable()->after('longitude');
            }
            if (!Schema::hasColumn('evidence', 'gps_accuracy')) {
                $table->decimal('gps_accuracy', 8, 2)->nullable()->after('altitude');
            }
            if (!Schema::hasColumn('evidence', 'device_info')) {
                $table->string('device_info', 500)->nullable()->after('captured_at');
            }
            if (!Schema::hasColumn('evidence', 'file_size')) {
                $table->unsignedBigInteger('file_size')->nullable()->after('file_hash');
            }
            if (!Schema::hasColumn('evidence', 'mime_type')) {
                $table->string('mime_type', 100)->nullable()->after('file_size');
            }
            if (!Schema::hasColumn('evidence', 'metadata')) {
                $table->json('metadata')->nullable()->after('device_info');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evidence', function (Blueprint $table) {
            $columns = ['altitude', 'gps_accuracy', 'device_info', 'file_size', 'mime_type', 'metadata'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('evidence', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
