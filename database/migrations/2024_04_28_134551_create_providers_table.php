<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheRealJanJanssens\BookingCore\Enums\ProviderType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name', 191)->default('');
            $table->string('description')->nullable();
            $table->enum('type', ProviderType::optionsWithoutLabel())->default(ProviderType::Person);
            $table->integer('capacity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
