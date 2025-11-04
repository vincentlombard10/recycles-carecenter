<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('assignee_email')->nullable();
            $table->bigInteger('assignee_id')->nullable();
            $table->json('attribute_value_ids')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->bigInteger('custom_status_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->json('email_cc_ids')->nullable();
            $table->string('requester_external_id')->nullable();
            $table->json('follower_ids')->nullable();
            $table->json('followup_ids')->nullable();
            $table->bigInteger('forum_topic_id')->nullable();
            $table->boolean('from_messaging_channel')->nullable();
            $table->integer('generated_timestamp')->nullable();
            $table->bigInteger('group_id')->nullable();
            $table->boolean('has_incidents')->nullable();
            $table->boolean('is_public')->nullable();
            $table->bigInteger('organization_id')->nullable();
            $table->string('priority')->nullable();
            $table->bigInteger('problem_id')->nullable();
            $table->string('raw_subject')->nullable();
            $table->string('recipient')->nullable();
            $table->bigInteger('requester_id');
            $table->json('satisfaction_rating')->nullable();
            $table->json('sharing_agreement_ids')->nullable();
            $table->string('status', 16)->nullable();
            $table->string('subject')->nullable();
            $table->bigInteger('submitter_id')->nullable();
            $table->json('tags')->nullable();
            $table->bigInteger('ticket_form_id')->nullable();
            $table->string('type')->nullable();
            $table->string('url')->nullable();
            $table->json('via')->nullable();
            $table->integer('first_reply_time_in_minutes')->nullable();
            $table->integer('first_reply_time_in_minutes_within_business_hours')->nullable();
            $table->integer('first_resolution_time_in_minutes')->nullable();
            $table->integer('first_resolution_time_in_minutes_within_business_hours')->nullable();
            $table->integer('full_resolution_time_in_minutes')->nullable();
            $table->integer('full_resolution_time_in_minutes_within_business_hours')->nullable();
            $table->integer('agent_wait_time_in_minutes')->nullable();
            $table->integer('agent_wait_time_in_minutes_within_business_hours')->nullable();
            $table->integer('requester_wait_time_in_minutes')->nullable();
            $table->integer('requester_wait_time_in_minutes_within_business_hours')->nullable();
            $table->integer('on_hold_time_in_minutes')->nullable();
            $table->integer('on_hold_time_in_minutes_within_business_hours')->nullable();
            $table->integer('first_reply_time_in_seconds')->nullable();
            $table->string('ticket_form_name')->nullable();
            $table->integer('reopens')->nullable();
            $table->integer('replies')->nullable();
            $table->string('assignee_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('satisfaction_score')->nullable();
            $table->string('requester_name')->nullable();
            $table->string('requester_email')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('solved_at')->nullable();
            $table->integer('comments_count')->nullable();
            $table->integer('fields_count')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
