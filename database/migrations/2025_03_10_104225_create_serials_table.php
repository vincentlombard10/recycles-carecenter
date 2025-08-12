<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('serials', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('item_itno');
            $table->timestamp('in')->nullable();
            $table->timestamp('out')->nullable();
            $table->string('dealer_code')->nullable();
            $table->string('order')->nullable();
            $table->string('delivery')->nullable();
            $table->foreignId('item_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serials');
    }
};
