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
        Schema::create('commands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('data');
            $table->timestamps();
            $table->unsignedInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('keyboards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('data');
            $table->timestamps();

            $table->unsignedInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedInteger('parent_id')->unsigned();
            $table->foreign('parent_id')
                ->references('id')
                ->on('keyboards')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedInteger('command_id')->unsigned();
            $table->foreign('command_id')
                ->references('id')
                ->on('commands')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('keyboards');
        Schema::drop('commands');
    }
}
