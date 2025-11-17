<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->string('name');
            $table->bigInteger('zendesk_user_id')->nullable()->index();
            $table->integer('status');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('postcode', 8)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('country', 2)->nullable();
            $table->string('salesrep', 12)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('zendesk_support')->default(true);
            $table->json('duplicates')->nullable();
            $table->boolean('support_enabled')->nullable()->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
