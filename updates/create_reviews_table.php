<?php namespace VojtaSvoboda\Reviews\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('vojtasvoboda_reviews_reviews', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('email', 300)->nullable();
            $table->string('name', 300)->nullable();
            $table->string('title', 300)->nullable();
            $table->smallInteger('rating')->nullable();
            $table->text('content')->nullable();
            $table->boolean('approved')->default(true);
            $table->boolean('sort_order')->nullable();

            $table->char('hash', 32);
            $table->char('locale', 10)->nullable();

            $table->string('ip', 300)->nullable();
            $table->string('ip_forwarded', 300)->nullable();
            $table->string('user_agent', 300)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vojtasvoboda_reviews_reviews');
    }
}
