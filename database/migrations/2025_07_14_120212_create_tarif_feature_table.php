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
        Schema::create('tarif_feature', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarif_id');
            $table->string('name', 255);
            $table->timestamp('date_created_at')->useCurrent();
            $table->timestamp('date_updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('tarif_id')
                ->references('id')
                ->on('tarif')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_feature');
    }
};
