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
            $table->integer('audit_id')->nullable();
            $table->integer('author_id')->nullable();
            $table->string('body')->nullable();
            $table->string('html_body')->nullable();
            $table->json('metadata')->nullable();
            $table->string('plain_body')->nullable();
            $table->boolean('public')->nullable();
            $table->string('type')->nullable();
            $table->json('uploads')->nullable();
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
