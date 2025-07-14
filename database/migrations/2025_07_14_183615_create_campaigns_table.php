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
        Schema::create('campaign', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps('update_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('type_campaign_id')
                    ->references('id')
                    ->on('type_campaign');

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
