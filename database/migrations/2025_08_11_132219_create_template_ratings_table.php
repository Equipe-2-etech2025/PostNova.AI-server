<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('template_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('campaign_templates')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('rating', 3, 2)->unsigned();
            $table->timestamps();
            $table->unique(['template_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('template_ratings');
    }
}
