<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('serial_additionals', function (Blueprint $table) {
            $table->id();
            $table->string('serial_code');
            $table->foreignId('serial_id');
            $table->string('qualificiation');
            $table->string('reference');
            $table->string('category');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serial_additionals');
    }
};
