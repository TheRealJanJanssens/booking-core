<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheRealJanJanssens\BookingCore\Enums\ProviderScheduleType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provider_schedule_exceptions', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('provider_uuid')->references('uuid')->on('providers');
            $table->string('name')->nullable();
            $table->datetime('start_at');
            $table->datetime('end_at');
            $table->enum('type', ProviderScheduleType::optionsWithoutLabel())->default(ProviderScheduleType::Unavailable);
            $table->timestamps();

            $table->index(['provider_uuid', 'start_at', 'end_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_schedule_exceptions');
    }
};
