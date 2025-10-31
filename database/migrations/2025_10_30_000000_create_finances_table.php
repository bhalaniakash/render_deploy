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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('description');
            $table->string('method')->default('cash'); // 'cash' or 'gpay'
            $table->string('category')->nullable();
            $table->decimal('income', 12, 2)->default(0);
            $table->decimal('expense', 12, 2)->default(0);
            $table->decimal('balance', 14, 2)->default(0);
            $table->decimal('cash_balance', 14, 2)->default(0);
            $table->decimal('gpay_balance', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
