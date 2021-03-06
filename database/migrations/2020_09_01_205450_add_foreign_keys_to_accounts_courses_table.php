<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAccountsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts_courses', function (Blueprint $table) {
            $table->foreign('account_id', 'FK_AC_ACCOUNT')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('course_id', 'FK_AC_COURSES')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts_courses', function (Blueprint $table) {
            $table->dropForeign('FK_AC_ACCOUNT');
            $table->dropForeign('FK_AC_COURSES');
        });
    }
}
