<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->bigInteger('author_id');
            $table->text('body')->nullable();
            $table->text('html_body')->nullable();
            $table->text('plain_body')->nullable();
            $table->boolean('public');
            $table->bigInteger('audit_id');
            $table->json('via')->nullable();
            $table->json('metadata')->nullable();
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
