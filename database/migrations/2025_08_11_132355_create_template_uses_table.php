<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateUsesTable extends Migration
{
    public function up()
    {
        Schema::create('template_uses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('campaign_templates')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('used_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('template_uses');
    }
}
