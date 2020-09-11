<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->json("specialty_ids");
            $table->enum("status", array_keys(\App\Models\Courses::getStatus()));
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->integer("duration")->unsigned();
            $table->json("credit");
            $table->json("books")->nullable();
            $table->json("videos")->nullable();
            $table->float("cost")->nullable();
            $table->text("content")->nullable();
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
        Schema::dropIfExists('courses');
    }
}
