<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('posts', function(Illuminate\Database\Schema\Blueprint $builder){
            $builder->increments('id');
            $builder->string('title');
            $builder->string('content', 3000);
            $builder->integer('user_id')->unsigned();

            $builder->timestamps();

            if(\Schema::hasTable('users'))
                $builder->foreign('user_id')->references('id')->on('users');
            //\Schema::table('posts',function($builder){
            //});
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::drop('posts');
    }
}
