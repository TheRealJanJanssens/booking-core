<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheRealJanJanssens\BookingCore\Enums\BookingStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('service_uuid')->references('uuid')->on('services');
            $table->foreignUuid('provider_uuid')->references('uuid')->on('providers');
            //$table->foreignUuid('client_uuid')->references('uuid')->on('users')->nullable(); //??
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->enum('status', BookingStatus::optionsWithoutLabel())->default(BookingStatus::Pending);
            $table->string('title')->default('');
            $table->float('price', 10, 0)->nullable()->default(0);
            $table->string('description', 500)->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['start_at', 'end_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
