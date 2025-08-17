<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('campaign_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            $table->foreignId('type_campaign_id')->constrained('type_campaigns')->onDelete('cascade');
            $table->string('author')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('preview')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('campaign_templates');
    }
}
