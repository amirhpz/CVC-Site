<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('posts')) {
            return;
        }

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('priority')->nullable()->comment('شماره اولویت نمایش');
            $table->string('title')->comment('عنوان محصول');
            $table->string('en_title')->nullable()->comment('عنوان انگلیسی');
            $table->string('sub_title')->nullable()->comment('زیر عنوان');
            $table->string('slug')->unique()->comment('نام قابل استفاده');
            $table->string('cover')->nullable()->comment('تصویر کاور');
            $table->string('file_path')->nullable()->comment('لینک فایل');
            $table->text('description')->nullable()->comment('توضیحات کلی');
            $table->longText('full_description')->nullable()->comment('توضیحات طولانی');
            $table->tinyInteger('status')->default(1)->comment('وضعیت نمایش');
            $table->unsignedBigInteger('user_id')->nullable()->comment('شناسه کاربری که این نقش را ایجاد کرده');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('posts')) {
            Schema::drop('posts');
        }
    }
};

