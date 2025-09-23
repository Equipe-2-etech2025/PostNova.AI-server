<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description');
            $table->integer('status');
            $table->boolean('is_published')->default(false);
            $table->string('business_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_numbers')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->string('location')->nullable();
            $table->text('target_audience')->nullable();
            $table->text('goals')->nullable();
            $table->string('budget')->nullable();
            $table->text('keywords')->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('preferred_style')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('type_campaign_id')->nullable();
            $table->foreign('type_campaign_id')
                ->references('id')
                ->on('type_campaigns');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
