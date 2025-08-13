<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateTagsTable extends Migration
{
    public function up()
    {
        Schema::create('template_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('campaign_templates')->onDelete('cascade');
            $table->string('tag', 50);
            $table->index('tag');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('template_tags');
    }
}
