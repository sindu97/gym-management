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
        Schema::create('special_plan_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('special_package_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_type_id')->constrained()->onDelete('cascade');
            $table->string('slug');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_plan_prices');
    }
};
