<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('firt_name');
            $table->string('last_name');
            $table->string('identification',10)->unique();
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('address');
            $table->date('birthday');
            $table->string('gender');
            $table->foreignId('id_cities')
                  ->constrained('cities');
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
        Schema::dropIfExists('persons');
    }
}
