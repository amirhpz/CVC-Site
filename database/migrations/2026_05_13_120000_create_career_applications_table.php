<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_code', 10);
            $table->date('birth_date');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('city');
            $table->string('province');
            $table->json('education')->nullable();
            $table->json('experience')->nullable();
            $table->text('skills')->nullable();
            $table->text('languages')->nullable();
            $table->string('position');
            $table->string('expected_salary');
            $table->string('availability');
            $table->string('resume_path');
            $table->string('documents_path')->nullable();
            $table->text('motivation')->nullable();
            $table->string('source')->nullable();
            $table->boolean('terms')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_applications');
    }
};

