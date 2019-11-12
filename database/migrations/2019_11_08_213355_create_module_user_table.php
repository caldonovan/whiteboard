<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // * Creates the pivot table between modules and users, for the many to many relationship
        Schema::create('module_user', function (Blueprint $table) {
            $table->primary(['module_id', 'user_id']);
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_user');
    }
}
