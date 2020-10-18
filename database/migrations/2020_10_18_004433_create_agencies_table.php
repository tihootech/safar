<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('latin_name');
            $table->string('manager_name')->nullable();
            $table->string('manager_phone')->nullable();
            $table->string('itguy_name')->nullable();
            $table->string('itguy_phone')->nullable();
            $table->string('license_type')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->text('brief_info')->nullable();
            $table->text('full_info')->nullable();
            $table->text('address')->nullable();
            $table->text('phones')->nullable();
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
        Schema::dropIfExists('agencies');
    }
}
