<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('country_id');
            $table->string('name');
            $table->string('latin_name');
            $table->string('type');
            $table->string('quiz');
            $table->string('first_picture');
            $table->string('counselings');
            $table->boolean('online_sopping')->default(0);
            $table->text('documents')->nullable();
            $table->text('conditions')->nullable();
            $table->text('issuance_time')->nullable();
            $table->text('issuance_steps')->nullable();
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
        Schema::dropIfExists('visas');
    }
}
