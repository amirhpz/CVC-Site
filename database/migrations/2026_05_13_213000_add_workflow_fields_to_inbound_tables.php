<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_messages', 'workflow_status')) {
                $table->string('workflow_status', 30)->default('new')->after('message');
            }
            if (!Schema::hasColumn('contact_messages', 'review_note')) {
                $table->text('review_note')->nullable()->after('workflow_status');
            }
            if (!Schema::hasColumn('contact_messages', 'reviewed_at')) {
                $table->timestamp('reviewed_at')->nullable()->after('review_note');
            }
            if (!Schema::hasColumn('contact_messages', 'reviewed_by')) {
                $table->unsignedBigInteger('reviewed_by')->nullable()->after('reviewed_at');
            }
        });

        Schema::table('career_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('career_applications', 'workflow_status')) {
                $table->string('workflow_status', 30)->default('new')->after('terms');
            }
            if (!Schema::hasColumn('career_applications', 'review_note')) {
                $table->text('review_note')->nullable()->after('workflow_status');
            }
            if (!Schema::hasColumn('career_applications', 'reviewed_at')) {
                $table->timestamp('reviewed_at')->nullable()->after('review_note');
            }
            if (!Schema::hasColumn('career_applications', 'reviewed_by')) {
                $table->unsignedBigInteger('reviewed_by')->nullable()->after('reviewed_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['workflow_status', 'review_note', 'reviewed_at', 'reviewed_by']);
        });

        Schema::table('career_applications', function (Blueprint $table) {
            $table->dropColumn(['workflow_status', 'review_note', 'reviewed_at', 'reviewed_by']);
        });
    }
};

