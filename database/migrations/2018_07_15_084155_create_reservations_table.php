<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->integer('day_no');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('room_id');
            $table->integer('allocation_id');
            $table->integer('schedule_id');
            $table->primary(['day_no', 'start_time', 'end_time', 'room_id', 'schedule_id'],
                'reservation_primary_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
