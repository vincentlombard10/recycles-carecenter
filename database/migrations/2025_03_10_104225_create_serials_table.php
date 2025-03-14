<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('serials', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('item_itno');
            $table->timestamp('in');
            $table->timestamp('out');
            $table->string('dealer_code');
            $table->string('order');
            $table->string('delivery');
            $table->string('group_code');
            $table->string('brand_code');
            $table->foreignId('group_id');
            $table->foreignId('brand_id');
            $table->foreignId('item_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serials');
    }
};
