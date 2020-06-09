<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 127);
            $table->string('surname', 127);
            $table->string('father_name', 127);
            $table->enum('gender', ['male', 'female']);
            $table->enum('married_status', ['married', 'single']);
            $table->date('bday');
            $table->string('phone');
            $table->string('passport');
            $table->date('date_of_issue');
            $table->date('date_of_expiry');
            $table->json('home_address');
            $table->json('work_address');
            $table->string('workplace_name');
            $table->string('image_name');
            $table->enum('role',['user', 'lecture']);
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
        Schema::dropIfExists('accounts');
    }
}
