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
        Schema::create('provider_schedules', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('provider_schedule_group_uuid')->references('uuid')->on('provider_schedule_groups');
            $table->tinyInteger('day_of_week');
            $table->time('start_at');
            $table->time('end_at');
            $table->timestamps();

            $table->index(['provider_schedule_group_uuid', 'day_of_week'], 'provider_schedule_group_dates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_schedules');
    }
};
