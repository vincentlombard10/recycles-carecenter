<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->json('attachments')->nullable();
            $table->bigInteger('audit_id')->nullable();
            $table->bigInteger('author_id')->nullable();
            $table->text('body')->nullable();
            $table->text('html_body')->nullable();
            $table->json('metadata')->nullable();
            $table->text('plain_body')->nullable();
            $table->boolean('public')->nullable();
            $table->string('type')->nullable();
            $table->json('via');
            $table->foreignId('ticket_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
