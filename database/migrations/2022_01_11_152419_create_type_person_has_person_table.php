<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePersonHasPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_person_has_person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_person')
                  ->constrained('persons');
            $table->foreignId('id_type_of_people')
                  ->constrained('types_of_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_person_has_person');
    }
}
