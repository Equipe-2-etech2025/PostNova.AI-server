<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('template_social_posts', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();

            $table->unsignedBigInteger('social_id');
            $table->foreign('social_id')
                ->references('id')
                ->on('socials')
                ->onDelete('cascade');

            $table->unsignedBigInteger('template_id');
            $table->foreign('template_id')
                ->references('id')
                ->on('campaign_templates')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('template_social_posts');
    }
};
