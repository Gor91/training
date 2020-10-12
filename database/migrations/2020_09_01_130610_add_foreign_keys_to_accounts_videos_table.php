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
<<<<<<< HEAD:database/migrations/2020_09_01_130610_add_foreign_keys_to_accounts_videos_table.php
        Schema::table('accounts_videos', function (Blueprint $table) {
            $table->foreign('account_id', 'FK_C_ACCOUNT')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('video_id', 'FK_C_VIDEO')->references('id')->on('videos')->onUpdate('CASCADE')->onDelete('CASCADE');
=======
        Schema::table('accounts_courses', function (Blueprint $table) {
            $table->foreign('account_id', 'FK_C_ACCOUNT')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('course_id', 'FK_C_COURSE')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
>>>>>>> e340b26c9162de10f25d995ffdc7ee9aba2976a7:database/migrations/2020_08_20_174605_add_foreign_keys_to_courses_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD:database/migrations/2020_09_01_130610_add_foreign_keys_to_accounts_videos_table.php
        Schema::table('accounts_videos', function (Blueprint $table) {

            $table->dropForeign('FK_C_ACCOUNT');
            $table->dropForeign('FK_C_VIDEO');
=======
        Schema::table('accounts_courses', function (Blueprint $table) {
            $table->dropForeign('FK_C_ACCOUNT');
            $table->dropForeign('FK_C_COURSE');
>>>>>>> e340b26c9162de10f25d995ffdc7ee9aba2976a7:database/migrations/2020_08_20_174605_add_foreign_keys_to_courses_table.php
        });
    }
}
