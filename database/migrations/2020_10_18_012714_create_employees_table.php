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
            $table->string('national_code')->unique()->nullable();
            $table->string('access_type')->nullable(); // COUNSELER, MANAGER
            $table->text('available_visas')->nullable(); // commo seperated list of visa_id
            $table->unsignedSmallInteger('rate')->default(0); // an integer max to 5
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
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
