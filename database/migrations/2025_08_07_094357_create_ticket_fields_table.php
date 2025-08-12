<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ticket_fields', function (Blueprint $table) {
            $table->string('id');
            $table->string('type');
            $table->string('title')->nullable();
            $table->string('raw_title')->nullable();
            $table->string('description')->nullable();
            $table->string('raw_description')->nullable();
            $table->integer('position');
            $table->boolean('active');
            $table->boolean('required');
            $table->boolean('collapsed_for_agents');
            $table->string('regexp_for_validation')->nullable();
            $table->string('title_in_portal')->nullable();
            $table->string('raw_title_in_portal')->nullable();
            $table->boolean('visible_in_portal');
            $table->boolean('editable_in_portal');
            $table->boolean('required_in_portal');
            $table->boolean('agent_can_edit');
            $table->string('tag')->nullable();
            $table->boolean('removable');
            $table->string('key')->nullable();
            $table->string('agent_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_fields');
    }
};
