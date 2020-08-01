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
            $table->date("duration_date")->nullable();
            $table->integer("credit");
            $table->enum("credit_type", array_keys(\App\Models\Courses::getCreditType()));
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
