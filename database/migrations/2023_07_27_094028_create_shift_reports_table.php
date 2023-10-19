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
        Schema::create('shift_reports', function (Blueprint $table) {
            $table->id();
            $table->date('report_date');
            $table->enum('report_shift', ['day', 'night']);
            $table->foreignId('user_id');
            $table->decimal('input_weight', 12, 3)->nullable();
            $table->decimal('output_weight', 12, 3)->nullable();
            $table->decimal('coil_ends_weight', 12, 3)->nullable();
            $table->longText('safety')->nullable();
            $table->longText('quality')->nullable();
            $table->longText('other')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_reports');
    }
};
