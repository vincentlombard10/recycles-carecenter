<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_reports', function (Blueprint $table) {
            $table->id();
            $table->string('identifier');
            $table->string('status');
            $table->string('reason')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('battery_key')->nullable();
            $table->boolean('antitheft_key')->nullable();
            $table->boolean('charger')->nullable();
            $table->boolean('battery')->nullable();
            $table->boolean('pedals')->nullable();
            $table->boolean('front_wheel')->nullable();
            $table->boolean('rear_wheel')->nullable();
            $table->boolean('saddle')->nullable();
            $table->boolean('seatpost')->nullable();
            $table->boolean('display')->nullable();
            $table->boolean('motor')->nullable();
            $table->text('presence_comment')->nullable();
            $table->boolean('stripes')->nullable();
            $table->boolean('corrosion')->nullable();
            $table->boolean('clay')->nullable();
            $table->boolean('sand')->nullable();
            $table->boolean('impacts')->nullable();
            $table->boolean('cracks')->nullable();
            $table->boolean('breakages')->nullable();
            $table->boolean('customizations')->nullable();
            $table->string('check_comment')->nullable();
            $table->string('issue_comment')->nullable();
            $table->string('battery_reference')->nullable();
            $table->string('battery_serial')->nullable();
            $table->string('battery_type')->nullable();
            $table->decimal('battery_voltage')->nullable();
            $table->decimal('battery_capacity')->nullable();
            $table->integer('battery_look')->nullable();
            $table->boolean('battery_charge')->nullable();
            $table->string('battery_issue')->nullable();
            $table->decimal('battery_current_voltage')->nullable();
            $table->decimal('battery_energy')->nullable();
            $table->integer('battery_cycles')->nullable();
            $table->string('battery_cells_state')->nullable();
            $table->decimal('battery_current_capacity')->nullable();
            $table->decimal('battery_temperature')->nullable();
            $table->decimal('battery_internal_resistance')->nullable();
            $table->text('diagnostic');
            $table->foreignId('return_id')->references('id')->on('product_returns')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_reports');
    }
};
