<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAccountsVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts_videos', function (Blueprint $table) {
            $table->foreign('account_id', 'FK_C_ACCOUNT')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('video_id', 'FK_C_VIDEO')->references('id')->on('videos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts_videos', function (Blueprint $table) {

            $table->dropForeign('FK_C_ACCOUNT');
            $table->dropForeign('FK_C_VIDEO');
        });
    }
}
