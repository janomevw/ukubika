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
        Schema::create('shift_report_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shift_report_id');
            $table->string('width');
            $table->string('thickness');
            $table->string('input_weight');
            $table->string('output_weight');
            $table->enum('grade', ['prime', 'rework', 'seconds', 'reworked']);
            $table->string('production_order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_report_items');
    }
};
