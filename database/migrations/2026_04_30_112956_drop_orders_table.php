<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('laws');
        Schema::dropIfExists('courts');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('versions');
        Schema::dropIfExists('offers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('log_estelams');
        Schema::dropIfExists('posts');

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('laws', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('log_estelams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

    }
};
