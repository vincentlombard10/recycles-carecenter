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
        Schema::create('bomitem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bom_id');
            $table->string('item_itno')->nullable();
            $table->string('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('group_code')->nullable();
            $table->string('brand_code')->nullable();
            $table->timestamp('from')->nullable();
            $table->timestamp('to')->nullable();
            $table->integer('status')->nullable();
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('bom_id')->constrained('boms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bomitem');
    }
};
