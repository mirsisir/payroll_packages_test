<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id')->nullable();

            // Personal Details
            $table->string('fname');
            $table->string('lname');
            $table->string('dob');
            $table->string('gender');
            $table->string('status')->nullable();
            $table->string('father')->nullable();
            $table->string('nation')->nullable();
            $table->string('nid')->nullable();
            $table->string('photo')->nullable();

            // Contact Details
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // Bank Information
            $table->string('bank')->nullable();
            $table->string('branch')->nullable();
            $table->string('acc_name')->nullable();
            $table->string('acc_number')->nullable();

            // Official Status
            $table->string('emp_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('designation_id')->nullable();
            $table->string('join_date')->nullable();

            // Employee Documents
            $table->string('resume')->nullable();
            $table->string('offer_let')->nullable();
            $table->string('join_let')->nullable();
            $table->string('contact_paper')->nullable();
            $table->string('id_proff')->nullable();
            $table->string('other')->nullable();


//            $table->timestamps();
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
