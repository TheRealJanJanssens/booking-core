<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('availability', function (Blueprint $table) {
            $table->uuid('provider_id');
            $table->primary(['provider_id', 'start_time']);

            // Timestamps
            $table->timestampTz('start_time');
            $table->timestampTz('end_time');

            // Foreign Keys
            $table->foreign('provider_id')
                  ->references('id')
                  ->on('providers')
                  ->onDelete('cascade');

            // Indexes
            $table->index('provider_id', 'availability_provider_index');
            $table->index(['start_time'], 'availability_start_time_index');
            $table->index(['end_time'], 'availability_end_time_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('availability');
    }
};
