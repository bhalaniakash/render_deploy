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
        Schema::table('finances', function (Blueprint $table) {
            $table->string('method')->default('cash')->after('description'); // 'cash' or 'gpay'
            $table->string('category')->nullable()->after('method');
            $table->decimal('cash_balance', 14, 2)->default(0)->after('balance');
            $table->decimal('gpay_balance', 14, 2)->default(0)->after('cash_balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finances', function (Blueprint $table) {
            $table->dropColumn(['method','category','cash_balance','gpay_balance']);
        });
    }
};
