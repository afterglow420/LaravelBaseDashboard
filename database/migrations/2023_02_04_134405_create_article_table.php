<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('articles')) {
            !Schema::create('articles', function (Blueprint $table) {
                $table->id('id_article');
                $table->string('article_title')->nullable();
                $table->text('article_text')->nullable();
                $table->string('article_photo')->nullable();
                $table->string('article_category')->nullable();
                $table->string('blog_category')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
};