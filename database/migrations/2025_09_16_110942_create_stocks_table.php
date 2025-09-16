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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->date("last_change_date");
            $table->string("supplier_article");
            $table->string("tech_size");
            $table->integer("barcode");
            $table->integer("quantity");
            $table->boolean("is_supply");
            $table->boolean("is_realization");
            $table->string("warehouse_name");
            $table->tinyInteger("in_way_to_client");
            $table->tinyInteger("in_way_from_client");
            $table->integer("nm_id");
            $table->string("subject");
            $table->string("category");
            $table->string("brand");
            $table->integer("sc_code");
            $table->string("price");
            $table->string("discount");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
