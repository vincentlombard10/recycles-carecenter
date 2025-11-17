<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productreturns', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->string('type')->nullable();
            $table->string('context')->nullable();
            $table->string('reason')->nullable();
            $table->string('assignation')->nullable();
            $table->string('action')->nullable();
            $table->string('destination')->nullable();
            $table->string('order')->nullable();
            $table->timestamp('bike_sold_at')->nullable();
            $table->timestamp('bike_purchased_at')->nullable();
            $table->string('invoice')->nullable();
            $table->string('delivery')->nullable();
            $table->string('info')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('routing_from_id')->references('id')->on('contacts');
            $table->string('routing_from_code')->nullable();
            $table->string('routing_from_name')->nullable();
            $table->string('routing_from_address1')->nullable();
            $table->string('routing_from_address2')->nullable();
            $table->string('routing_from_postcode')->nullable();
            $table->string('routing_from_city')->nullable();
            $table->string('routing_from_phone')->nullable();
            $table->string('routing_from_email')->nullable();
            $table->string('routing_from_info')->nullable();
            $table->foreignId('routing_to_id')->references('id')->on('contacts');
            $table->string('routing_to_code')->nullable();
            $table->string('routing_to_name')->nullable();
            $table->string('routing_to_address1')->nullable();
            $table->string('routing_to_address2')->nullable();
            $table->string('routing_to_postcode')->nullable();
            $table->string('routing_to_city')->nullable();
            $table->string('routing_to_phone')->nullable();
            $table->string('routing_to_email')->nullable();
            $table->string('routing_to_info')->nullable();
            $table->foreignId('return_to_id')->references('id')->on('contacts');
            $table->string('return_to_code')->nullable();
            $table->string('return_to_name')->nullable();
            $table->string('return_to_address1')->nullable();
            $table->string('return_to_address2')->nullable();
            $table->string('return_to_postcode')->nullable();
            $table->string('return_to_city')->nullable();
            $table->string('return_to_phone')->nullable();
            $table->string('return_to_email')->nullable();
            $table->string('return_to_info')->nullable();
            $table->foreignId('ticket_id')->nullable()->constrained();
            $table->string('zendesk_id')->nullable();
            $table->foreignId('serial_id')->nullable()->constrained();
            $table->string('serial_code')->nullable();
            $table->string('serial_itno')->nullable();
            $table->string('serial_itds')->nullable();
            $table->string('serial_itcl')->nullable();
            $table->foreignId('item_id')->nullable()->constrained();
            $table->string('item_itno')->nullable();
            $table->foreignId('author_id')->nullable()->references('id')->on('users');
            $table->foreignId('validator_id')->nullable()->references('id')->on('users');
            $table->foreignId('receiver_id')->nullable()->references('id')->on('users');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->timestamp('validatedx_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->enum('environment', ['production', 'sandbox'])->default('production');
            $table->softDeletes();
            $table->integer('duration_time_in_seconds')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_returns');
    }
};
