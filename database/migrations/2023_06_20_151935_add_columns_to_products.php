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
        Schema::table('products', function (Blueprint $table) {
            $table->string('price_min')->nullable();
            $table->string('price_max')->nullable();
            $table->string('full_name')->nullable();
            $table->string('extended_name')->nullable();
            $table->string('html_url')->nullable();
            $table->string('review_url')->nullable();
            $table->string('forum_url')->nullable();
            $table->string('forum_post_url')->nullable();
            $table->string('key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
