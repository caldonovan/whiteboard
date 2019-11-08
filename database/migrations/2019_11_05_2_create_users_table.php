<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('isLecturer')->default(false);
            //TODO: Add foreign keys for Course, Modules, posts and comments
            /*$table->unsignedBigInteger('posts')->nullable();
            $table->unsignedBigInteger('enrolled_modules')->nullable();
            $table->unsignedBigInteger('enrolled_courses')->nullable();
            $table->unsignedBigInteger('comments')->nullable();*/
            $table->rememberToken();
            $table->timestamps();

            // * Foreign keys for posts, courses, modules and comments. All of which are nullable
            //$table->foreign('posts')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade'); // * One to Many
            //$table->foreign('enrolled_modules')->references('id')->on('modules')->onDelete('cascade')->onUpdate('cascade'); // * Many to Many
            //$table->foreign('enrolled_courses')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade'); // * Many to Many
            //$table->foreign('comments')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade'); // * One to Many


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
