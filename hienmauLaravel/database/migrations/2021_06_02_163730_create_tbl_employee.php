<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_employee', function (Blueprint $table) {
            $table->increments('employee_id');//tu khoa chinh va tu dong tang
            $table->integer('hospital_id');
            $table->string('employee_name',255);
            $table->string('employee_title',255);
            $table->string('employee_department',255);
            $table->string('employee_phone',50);
            $table->string('employee_email',255);
            $table->integer('employee_status');
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
        Schema::dropIfExists('tbl_employee');
    }
}
