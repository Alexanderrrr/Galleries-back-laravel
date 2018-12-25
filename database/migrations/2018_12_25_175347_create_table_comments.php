<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
          $table->increments('id');
          $table->text('content');
          $table->unsignedInteger('user_id'); //ne moze biti negativan
          $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); //da se obrisu svi komentari na delete
          $table->unsignedInteger('gallery_id'); //ne moze biti negativan
          $table->foreign('gallery_id')
                ->references('id')
                ->on('galleries')
                ->onDelete('cascade'); //da se obrisu svi komentari na delete
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
        Schema::dropIfExists('comments');
    }
}
