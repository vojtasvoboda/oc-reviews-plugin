<?php namespace VojtaSvoboda\Reviews\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateReviewCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('vojtasvoboda_reviews_review_category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('review_id')->unsigned()->nullable()->default(null);
            $table->integer('category_id')->unsigned()->nullable()->default(null);
            $table->index(['review_id', 'category_id']);
            $table->foreign('review_id')->references('id')->on('vojtasvoboda_reviews_reviews')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('vojtasvoboda_reviews_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vojtasvoboda_reviews_review_category');
    }
}
