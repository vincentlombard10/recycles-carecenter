<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('itno')->unique();
            $table->string('itds');
            $table->string('label')->nullable();
            $table->string('brand_code')->nullable();
            $table->string('group_code')->nullable();
            $table->string('item_code')->nullable();
            $table->foreignId('group_id')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->foreignId('item_id')->nullable();
            $table->integer('status')->default(20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
