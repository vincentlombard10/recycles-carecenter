<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->boolean('allow_attachments')->nullable();
            $table->boolean('allow_channelback')->nullable();
            $table->string('assignee_email')->nullable();
            $table->integer('assignee_id')->nullable();
            $table->json('attribute_value_ids')->nullable();
            $table->integer('brand_id')->nullable();
            $table->json('collaborator_ids')->nullable();
            $table->json('collaborators')->nullable();
            $table->json('custom_fields')->nullable();
            $table->integer('custom_status_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->json('email_cc_ids')->nullable();
            $table->string('external_id')->nullable();
            $table->json('follower_ids')->nullable();
            $table->json('followup_ids')->nullable();
            $table->integer('forum_topic_id')->nullable();
            $table->boolean('from_messaging_channel')->nullable();
            $table->timestamp('generated_timestamp')->nullable();
            $table->integer('group_id')->nullable();
            $table->boolean('has_incidents')->nullable();
            $table->boolean('is_public')->nullable();
            $table->integer('organization_id')->nullable();
            $table->string('priority')->nullable();
            $table->integer('problem_id')->nullable();
            $table->string('raw_subject')->nullable();
            $table->string('recipient')->nullable();
            $table->integer('requester_id');
            $table->json('satisfaction_rating')->nullable();
            $table->json('sharing_agreement_ids')->nullable();
            $table->smallInteger('status')->nullable();
            $table->string('subject')->nullable();
            $table->integer('submitter_id')->nullable();
            $table->json('tags')->nullable();
            $table->integer('ticket_form_id')->nullable();
            $table->string('type')->nullable();
            $table->string('url')->nullable();
            $table->json('via')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
