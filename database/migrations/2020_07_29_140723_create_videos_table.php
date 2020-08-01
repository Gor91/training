<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('path');
            $table->float('duration')->nullable();
            $table->bigInteger('lectures_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->foreign('lectures_id', 'FK_VIDEOS_ACCOUNTS')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign('FK_VIDEOS_ACCOUNTS');
        });

        Schema::dropIfExists('videos');
    }
}
