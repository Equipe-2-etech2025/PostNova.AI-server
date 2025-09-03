<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('social_posts', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();

            $table->unsignedBigInteger('social_id');
            $table->foreign('social_id')
                ->references('id')
                ->on('socials');

            $table->unsignedBigInteger('campaign_id');
            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')
                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('social_posts');
    }
};
