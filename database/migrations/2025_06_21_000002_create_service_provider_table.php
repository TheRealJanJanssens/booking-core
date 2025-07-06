<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_provider', function (Blueprint $table) {
            $table->uuid('service_id');
            $table->uuid('provider_id');

            $table->primary(['service_id', 'provider_id']);

            $table->decimal('price', 8, 2)->nullable();
            $table->integer('duration')->nullable();

            // Foreign keys
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');

            // Timestamps
            $table->timestamp('created_at')->useCurrent()->timezone('UTC+01:00');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->timezone('UTC+01:00');

            // indexes
            $table->index('service_id', 'service_provider_service_index');
            $table->index('provider_id', 'service_provider_provider_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_provider');
    }
};
