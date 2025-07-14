<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('tarif_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarif_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('date_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('expired_at')->nullable();

            $table->foreign('tarif_id')
                ->references('id')
                ->on('tarif')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarif_user');
    }
};
