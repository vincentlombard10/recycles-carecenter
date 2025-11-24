<?php

use App\Models\Estimate;
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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productreport_id')->constrained('productreports');
            $table->enum('state', [
                Estimate::STATUS_PENDING,
                Estimate::STATUS_APPROVED,
                Estimate::STATUS_REJECTED
            ])->default(Estimate::STATUS_PENDING);
            $table->integer('workflow_duration')->unsigned()->nullable();
            $table->integer('workflow_duration_within_business_hours')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
