<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHospital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hospital', function (Blueprint $table) {
            $table->increments('hospital_id');//tu khoa chinh va tu dong tang
            $table->string('hospital_name',255);
            $table->string('hospital_address',255);
            $table->string('hospital_email',255);
            $table->string('hospital_phone',50);
            $table->integer('hospital_status');
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
        Schema::dropIfExists('tbl_hospital');
    }
}
