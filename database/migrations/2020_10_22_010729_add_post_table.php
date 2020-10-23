<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("post", function(Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("content");
            $table->bigInteger("user_id")->unsigned();
            $table->timestamps();
            $table->unique("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
