<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tarif_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarif_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('expired_at')->nullable();

            $table->foreign('tarif_id')
                ->references('id')
                ->on('tarifs');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarif_users');
    }
};
