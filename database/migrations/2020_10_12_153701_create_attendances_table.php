<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); //MySQL don't support UUID as primary key
            $table->bigInteger('pet_id')->unsigned();
            $table->date('date');
            $table->text('description')->nullable(true);
            $table->timestamps();

            $table->foreign('pet_id')
                ->references('id')
                ->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
