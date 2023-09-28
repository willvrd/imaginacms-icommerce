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
        Schema::table('icommerce__orders', function (Blueprint $table) {
            $table->boolean('guest_purchase')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('icommerce__orders', function (Blueprint $table) {
            $table->dropColumn('guest_purchase');
        });
    }
};
