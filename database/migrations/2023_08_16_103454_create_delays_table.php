<?php

use App\Models\Department;
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
        Schema::create('delays', function (Blueprint $table) {
            $table->id();
            $table->dateTime('delay_start');
            $table->dateTime('delay_end');
            $table->string('report_date');
            $table->string('shift');
            $table->integer('duration');
            $table->foreignIdFor(Department::class);
            $table->enum('type', ['planned', 'unplanned']);
            $table->longText('reason');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delays');
    }
};
