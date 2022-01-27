<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_appointment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_appointments')
                  ->constrained('appointments');
            $table->foreignId('id_exam')
                  ->constrained('exams');
            $table->string('result');
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('exam_appointment');
    }
}
