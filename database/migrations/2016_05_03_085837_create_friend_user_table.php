<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reqr_id')
                    ->unsigned();
            $table->foreign('reqr_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->integer('friend_id')
                    ->unsigned();
            $table->foreign('friend_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
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
        Schema::drop('friend_user');
    }
}
