<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('posts') || Schema::hasColumn('posts', 'gallery_media')) {
            return;
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->json('gallery_media')->nullable()->after('file_path');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('posts') || !Schema::hasColumn('posts', 'gallery_media')) {
            return;
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('gallery_media');
        });
    }
};
