<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialistsScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialists_schedule', function (Blueprint $table) {
            $table->id();
            $table->string('comment')->nullable();
            $table->boolean('availability');
            $table->foreignId('id_specialists')
                  ->constrained('specialists');
            $table->foreignId('id_schedule')
                  ->constrained('schedule');
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
        Schema::dropIfExists('specialists_schedule');
    }
}
