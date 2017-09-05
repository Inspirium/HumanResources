<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('image')->nullable();
            $table->string('mobile_pre')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobile_vpn')->nullable();
            $table->string('phone_pre')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_vpn')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('room')->nullable();
            $table->string('sex')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
