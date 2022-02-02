<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineHasAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_has_appointment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_appointment')
                  ->constrained('appointments');
            $table->foreignId('id_medicine')
                  ->constrained('medicines');
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
        Schema::dropIfExists('medicine_has_appointment');
    }
}
