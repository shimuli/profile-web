<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleModelTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_model_tags', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('article_model_id')->index();
            $table->foreign('article_model_id')->references('id')->on('article_models')->onDelete('cascade');

            $table->unsignedBigInteger('tags_id')->index();
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_model_tags');
    }
}
