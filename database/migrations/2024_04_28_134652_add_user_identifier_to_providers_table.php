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
            $forgeinColumn = IdentifierResolver::foreignKeyFor('user');
            $identifier = IdentifierResolver::usesUuid('user') ? 'uuid' : 'id';
            $foreignMethod = 'foreign'.ucfirst($identifier);
var_dump($forgeinColumn);
            $table->{$identifier}($forgeinColumn)->nullable();
            $table->foreign($forgeinColumn)->references($identifier)->on('users')->nullOnDelete();
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
