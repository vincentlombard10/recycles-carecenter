<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ticket_field_items', function (Blueprint $table) {
            $table->foreignUuid('ticket_field_id');
            $table->foreignId('ticket_id');
            $table->string('value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_field_items');
    }
};
