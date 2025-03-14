<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('content_type')->nullable();
            $table->string('content_url')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('file_name')->nullable();
            $table->string('height')->nullable();
            $table->boolean('inline')->nullable();
            $table->boolean('malware_access_override')->nullable();
            $table->string('malware_scan_result')->nullable();
            $table->string('mapped_content_url')->nullable();
            $table->integer('size')->nullable();
            $table->json('thumbnails')->nullable();
            $table->string('url')->nullable();
            $table->string('width')->nullable();
            $table->foreignId('comment_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
