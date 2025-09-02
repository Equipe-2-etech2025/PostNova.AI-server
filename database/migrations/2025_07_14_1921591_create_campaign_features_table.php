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
        Schema::create('campaign_features', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('campaign_id');
            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns');

            $table->unsignedBigInteger('feature_id');
            $table->foreign('feature_id')
                ->references('id')
                ->on('features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_features');
    }
};
