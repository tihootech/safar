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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('agency_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_code')->nullable();
            $table->string('access_type')->nullable();
            $table->string('available_licenses')->nullable();
            $table->unsignedSmallInteger('rate')->default(0);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('info')->nullable();
            $table->text('schedule')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
