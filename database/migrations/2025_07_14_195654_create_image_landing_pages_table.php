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
        Schema::create('image_landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('type', 255);
            $table->string('url', 255);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('is_published')->default(false);

            $table->unsignedBigInteger('camp_id');
            $table->foreign('camp_id')
                    ->references('id')
                    ->on('campaigns')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_landing_pages');
    }
};
