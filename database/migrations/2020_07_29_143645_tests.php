<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('courses_id')->unsigned()->nullable();
            $table->text('question')->nullable(false);
            $table->text('answers')->jsonSerialize();
            $table->string('question_icons_paths')->nullable()->jsonSerialize();
            $table->string('answers_icons_paths')->nullable()->jsonSerialize();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->foreign('courses_id', 'fk_courses')
                ->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropForeign('fk_courses');
        });
    }
}
