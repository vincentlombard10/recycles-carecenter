<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productreports', function (Blueprint $table) {
            $table->id();
            $table->string('identifier');
            $table->string('type')->nullable();
            $table->string('status');
            $table->enum('battery_key', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('battery_key_qty')->unsigned()->nullable();
            $table->enum('lock_key', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('lock_key_qty')->unsigned()->nullable();
            $table->enum('charger', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('charger_qty')->unsigned()->nullable();
            $table->enum('battery', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('battery_qty')->unsigned()->nullable();
            $table->enum('pedals', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('pedals_qty')->unsigned()->nullable();
            $table->enum('front_wheel', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('front_wheel_qty')->unsigned()->nullable();
            $table->enum('rear_wheel', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('rear_wheel_qty')->unsigned()->nullable();
            $table->enum('saddle', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('saddle_qty')->unsigned()->nullable();
            $table->enum('seatpost', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('seatpost_qty')->unsigned()->nullable();
            $table->enum('display', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('display_qty')->unsigned()->nullable();
            $table->enum('motor', ['yes', 'no', 'none'])->nullable();
            $table->smallInteger('motor_qty')->unsigned()->nullable();
            $table->text('presence_comment')->nullable();
            $table->integer('odo')->nullable();
            $table->string('defect')->nullable();
            $table->string('description')->nullable();
            $table->string('tests')->nullable();
            $table->enum('stripes', ['yes', 'no'])->nullable();
            $table->enum('corrosion', ['yes', 'no'])->nullable();
            $table->enum('clay', ['yes', 'no'])->nullable();
            $table->enum('sand', ['yes', 'no'])->nullable();
            $table->enum('impacts', ['yes', 'no'])->nullable();
            $table->enum('cracks', ['yes', 'no'])->nullable();
            $table->enum('breakage', ['yes', 'no'])->nullable();
            $table->enum('modification',['yes', 'no'])->nullable();
            $table->string('look_comment')->nullable();
            $table->string('battery_reference')->nullable();
            $table->string('battery_serial')->nullable();
            $table->string('battery_type')->nullable();
            $table->string('battery_nominal_voltage', 16)->nullable();
            $table->decimal('battery_nominal_capacity')->nullable();
            $table->text('battery_look_states')->nullable();
            $table->string('battery_look_custom_state')->nullable();
            $table->enum('battery_indicator', ['yes', 'no'])->nullable();
            $table->string('battery_error_codes')->nullable();
            $table->enum('battery_charge_state', ['good', 'bad'])->nullable();
            $table->decimal('battery_charge_voltage')->nullable();
            $table->decimal('battery_energy')->nullable();
            $table->boolean('bms_state')->default(1)->nullable();
            $table->integer('battery_charge_cycles')->nullable();
            $table->string('battery_cells_state')->nullable();
            $table->decimal('battery_usable_capacity')->nullable();
            $table->decimal('battery_temperature')->nullable();
            $table->decimal('battery_internal_resistance')->nullable();
            $table->text('diagnostic')->nullable();
            $table->string('order', 16)->nullable();
            $table->foreignId('technician_id')->nullable()->references('id')->on('users');
            $table->foreignId('productreturn_id')->references('id')->on('productreturns')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->integer('duration_time_in_seconds')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_reports');
    }
};
