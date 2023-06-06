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
        Schema::create('catalog_product', function (Blueprint $table) {
            $table->unsignedInteger("catalog_id")->comment("Связь с категорией");
            $table->unsignedInteger("product_id")->comment("Связь с продуктом");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
