<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->increments('users_id');
            $table->string('users_fullname',255);
            $table->string('users_name',255);
            $table->string('users_blood',255);
            $table->string('users_email',255);
            $table->string('users_phone',255);
            $table->string('users_cmnd',255);
            $table->string('users_password',255);
            $table->integer('users_gender',255);
            $table->date('users_date',255);
            $table->string('users_school',255);
            $table->string('users_job',255);
            $table->string('users_workplace',255);
            $table->string('users_address',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users');
    }
}
