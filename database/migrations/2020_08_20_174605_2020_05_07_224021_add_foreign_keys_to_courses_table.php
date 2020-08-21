<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('account_id', 'FK_C_ACCOUNT')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('specialty_id', 'FK_C_SPECIALTY')->references('id')->on('specialties')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {

            $table->dropForeign('FK_C_ACCOUNT');
            $table->dropForeign('FK_C_SPECIALTY');
        });
    }
}
