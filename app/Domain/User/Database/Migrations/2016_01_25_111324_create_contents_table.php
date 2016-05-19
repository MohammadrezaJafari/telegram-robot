<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('summary');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('mobile');
            $table->string('area');
            $table->text('description');
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
        Schema::drop('contents');
        Schema::drop('orders');
        Schema::drop('slides');
        Schema::drop('galleries');

    }
}
