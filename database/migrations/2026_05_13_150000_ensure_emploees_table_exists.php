<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('emploees')) {
            return;
        }

        Schema::create('emploees', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('slug')->nullable()->unique();
            $table->string('side')->nullable();
            $table->string('phone')->nullable();
            $table->string('instagram')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('priority')->nullable();
            $table->tinyInteger('status')->default(4);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emploees');
    }
};

