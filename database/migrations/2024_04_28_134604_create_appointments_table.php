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
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('service_uuid')->nullable();
            $table->uuid('provider_uuid')->nullable();
            $table->uuid('client_uuid')->nullable(); //??
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->string('title')->default('');
            $table->float('price', 10, 0)->nullable()->default(0);
            $table->string('description', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
