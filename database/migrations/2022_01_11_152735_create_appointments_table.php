<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->text('prescription')->nullable();
            $table->text('comment')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('reason');
            $table->foreignId('id_person')
                  ->constrained('persons');
            $table->foreignId('id_specialist')
                  ->constrained('specialists');
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
        Schema::dropIfExists('appointments');
    }
}
