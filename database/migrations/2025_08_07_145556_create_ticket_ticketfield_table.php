<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ticket_ticketfield', function (Blueprint $table) {
            $table->foreignUuid('ticketfield_id');
            $table->foreignId('ticketid');
            $table->string('value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_ticketfield');
    }
};
