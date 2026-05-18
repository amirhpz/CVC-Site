<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('products')) {
            return;
        }

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('priority')->nullable();
            $table->string('title');
            $table->string('en_title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('slug')->unique();
            $table->string('item1')->nullable();
            $table->string('item2')->nullable();
            $table->string('item3')->nullable();
            $table->string('item4')->nullable();
            $table->string('item5')->nullable();
            $table->string('price')->default(0);
            $table->string('cover')->nullable();
            $table->string('file_path')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_use')->nullable();
            $table->string('product_time')->nullable();
            $table->string('level')->nullable();
            $table->text('description')->nullable();
            $table->longText('full_description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('exp_date')->nullable();
            $table->boolean('certificate')->default(0);
            $table->string('cover_certificate')->nullable();
            $table->string('type_certificate')->nullable();
            $table->string('price_certificate')->nullable();
            $table->unsignedBigInteger('count_view')->default(0);
            $table->unsignedBigInteger('count_click')->default(0);
            $table->unsignedBigInteger('count_download')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

