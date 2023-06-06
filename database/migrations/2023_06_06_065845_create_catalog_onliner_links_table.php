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
        Schema::create('catalog_onliner_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('catalog_onliner_id');
            $table->string('url');
            $table->string('name');
            $table->string('attr_href')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_onliner_links');
    }
};
