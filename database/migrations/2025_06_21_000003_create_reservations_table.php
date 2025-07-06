<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('service_id');
            $table->uuid('provider_id');
            $table->uuid('user_id'); // User which makes the reservation

            $table->string('status')->default('pending'); // pending, confirmed, cancelled, completed
            $table->text('notes')->nullable();

            // Timestamps
            $table->timestampTz('start_time');
            $table->timestampTz('end_time');
            $table->timestamp('created_at')->useCurrent()->timezone('UTC+01:00');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->timezone('UTC+01:00');

            // Foreign Keys
            $table->foreign('service_id')
                  ->references('id')
                  ->on('services')
                  ->onDelete('cascade');

            $table->foreign('provider_id')
                  ->references('id')
                  ->on('providers')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Indexes
            $table->index('service_id', 'reservations_service_index');
            $table->index('provider_id', 'reservations_provider_index');
            $table->index('user_id', 'reservations_user_index');
            $table->index('status', 'reservations_status_index');
            $table->index(['start_time'], 'reservations_start_time_index');
            $table->index(['end_time'], 'reservations_end_time_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
