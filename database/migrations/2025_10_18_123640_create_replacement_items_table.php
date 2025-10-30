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
        Schema::create('replacement_items', function (Blueprint $table) {
            $table->id();
            $table->string('itno')->unique();
            $table->string('itds')->nullable();
            $table->unsignedBigInteger('quantity');
            $table->boolean('care')->nullable();
            $table->foreignId('productreport_id')->nullable()->constrained('productreports');
            $table->foreignId('item_id')->nullable()->constrained('items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replacement_items');
    }
};
