<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheRealJanJanssens\BookingCore\Enums\ProviderType;
use TheRealJanJanssens\BookingCore\Support\IdentifierResolver;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            $column = IdentifierResolver::foreignKeyFor('user');
            $type = IdentifierResolver::usesUuid('user') ? 'uuid' : 'id';

            $table->{$type}($column)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->dropColumn('comments');
        });
    }
};
