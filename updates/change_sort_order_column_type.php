<?php namespace VojtaSvoboda\Reviews\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;


class ChangeSortOrderColumnType extends Migration
{
    public function up()
    {
        Schema::table('vojtasvoboda_reviews_reviews', static function (Blueprint $table) {
            $table->integer('sort_order')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('vdlp_redirect_clients', static function (Blueprint $table) {
            $table->boolean('sort_order')->nullable()->change();
        });
    }
}
