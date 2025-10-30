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
        Schema::create('batterystate_productreport', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productreport_id');
            $table->unsignedBigInteger('batterystate_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battery_state_product_report');
    }
};
