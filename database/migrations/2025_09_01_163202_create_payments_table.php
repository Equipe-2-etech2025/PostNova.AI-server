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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('amount');
            $table->string('currency')->default('Ar');
            $table->string('description')->nullable();
            $table->string('customer_msisdn');   // Numéro client
            $table->string('merchant_msisdn');   // Numéro marchand
            $table->string('status')->nullable();
            $table->string('server_correlation_id');
            $table->string('transaction_reference');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
