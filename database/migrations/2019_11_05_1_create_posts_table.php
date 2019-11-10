<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('title');
            $table->mediumText('body');
            $table->integer('unique_views')->default(0); // * How many unique views a post has (in the form of a sum of the users who have seen it)
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('cover_image')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
