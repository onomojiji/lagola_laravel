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
        Schema::create('company_has_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Company::class)->constrained()->onDelete("cascade");
            $table->foreignIdFor(\App\Models\Product::class)->constrained()->onDelete("cascade");
            $table->time("date");
            $table->integer("quantity");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_has_products');
    }
};