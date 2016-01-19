<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('users', function(Illuminate\Database\Schema\Blueprint $builder){
            $builder->increments('id');

            $builder->string('login');
            $builder->string('password');
            $builder->string('name');
            $builder->string('surname');

            $builder->timestamps();
        });

        \Schema::table('posts', function (Blueprint $table) {
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
        \Schema::drop('users');
    }

}
