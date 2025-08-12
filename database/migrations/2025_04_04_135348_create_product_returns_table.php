<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_returns', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('context')->nullable();
            $table->string('reason')->nullable();
            $table->string('assignation')->nullable();
            $table->string('action')->nullable();
            $table->string('destination')->nullable();
            $table->string('order')->nullable();
            $table->timestamp('bike_sold_at')->nullable();
            $table->string('invoice')->nullable();
            $table->string('delivery')->nullable();
            $table->string('info')->nullable();
            $table->string('comment')->nullable();
            $table->string('routing_from_code')->nullable();
            $table->string('routing_from_name')->nullable();
            $table->string('routing_from_address1')->nullable();
            $table->string('routing_from_address2')->nullable();
            $table->string('routing_from_postalcode')->nullable();
            $table->string('routing_from_city')->nullable();
            $table->string('routing_to_code')->nullable();
            $table->string('routing_to_name')->nullable();
            $table->string('routing_to_address1')->nullable();
            $table->string('routing_to_address2')->nullable();
            $table->string('routing_to_postalcode')->nullable();
            $table->string('routing_to_city')->nullable();
            $table->string('return_code')->nullable();
            $table->string('return_name')->nullable();
            $table->string('return_address1')->nullable();
            $table->string('return_address2')->nullable();
            $table->string('return_postalcode')->nullable();
            $table->string('return_city')->nullable();
            $table->foreignId('ticket_id')->nullable()->constrained();
            $table->string('ticket_zendesk_id')->nullable();
            $table->foreignId('serial_id')->nullable()->constrained();
            $table->foreignId('item_id')->nullable()->constrained();
            $table->foreignId('author_id')->references('id')->on('users');
            $table->foreignId('from_id')->references('id')->on('contacts');
            $table->foreignId('to_id')->references('id')->on('contacts');
            $table->foreignId('reshipment_id')->references('id')->on('contacts');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_returns');
    }
};
