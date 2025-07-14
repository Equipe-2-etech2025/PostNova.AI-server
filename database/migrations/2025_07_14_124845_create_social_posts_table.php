<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('social_posts', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->timestamp('date_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('date_updated_at')->nullable();

            $table->unsignedBigInteger('social_id');
            $table->foreign('social_id')
                ->references('id')
                ->on('socials')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_posts');
    }
};
