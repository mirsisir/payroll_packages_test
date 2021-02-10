<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_infos', function (Blueprint $table) {
            $table->id();

            $table->string('employee_id');
            $table->string('employee_type');
            $table->string('basic_salary');
            $table->string('house_rent')->nullable();
            $table->string('medical')->nullable();
            $table->string('special_allowance')->nullable();
            $table->string('fuel_allowance')->nullable();
            $table->string('phone_bill')->nullable();
            $table->string('other_allowance')->nullable();

//            deduction
            $table->string('provident_fund')->nullable();
            $table->string('tax_deduction')->nullable();
            $table->string('other_deduction')->nullable();
//            total
            $table->string('total_deduction')->nullable();
            $table->string('net_salary');
            $table->string('gross_salary');

            $table->string('client_id')->nullable();
            $table->string('user_id')->nullable();
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
        Schema::dropIfExists('salary_infos');
    }
}
