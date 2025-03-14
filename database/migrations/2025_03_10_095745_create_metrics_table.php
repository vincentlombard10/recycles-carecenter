<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->json('agent_wait_time_in_minutes')->nullable();
            $table->string('assigned_at')->nullable();
            $table->integer('assignee_stations')->nullable();
            $table->timestamp('assignee_updated_at')->nullable();
            $table->timestamp('custom_status_updated_at')->nullable();
            $table->json('first_resolution_time_in_minutes')->nullable();
            $table->json('full_resolution_time_in_minutes')->nullable();
            $table->integer('group_stations')->nullable();
            $table->timestamp('initially_assigned_at')->nullable();
            $table->timestamp('latest_comment_added_at')->nullable();
            $table->timestamp('on_hold_time_in_minutes')->nullable();
            $table->integer('reopens')->nullable();
            $table->integer('replies')->nullable();
            $table->integer('reply_time_in_minutes')->nullable();
            $table->integer('reply_time_in_seconds')->nullable();
            $table->timestamp('requester_updated_at')->nullable();
            $table->json('requester_wait_time_in_minutes')->nullable();
            $table->timestamp('solved_at')->nullable();
            $table->timestamp('status_updated_at')->nullable();
            $table->string('url')->nullable();
            $table->foreignId('ticket_id')->nullable();;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metrics');
    }
};
