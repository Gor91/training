<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('count')->unsigned();
            $table->enum('status',['success', 'unsuccess']);
            $table->float('percent')->nullable();
            $table->integer('raiting')->nullable();
            $table->string('comment')->nullable();
            $table->string('panding')->default('unread');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts_courses');
    }
}
