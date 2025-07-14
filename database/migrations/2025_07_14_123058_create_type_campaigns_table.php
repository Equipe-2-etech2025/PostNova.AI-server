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
        Schema::create('type_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->timestamp('date_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('date_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_campaigns');
    }
};
