<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('duration'); // Duration in minutes
            $table->decimal('price', 8, 2); // Price with 2 decimals

            // Timestamps
            $table->timestamp('created_at')->useCurrent()->timezone('UTC+01:00');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->timezone('UTC+01:00');

            // Indexes
            $table->index('name', 'services_name_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
