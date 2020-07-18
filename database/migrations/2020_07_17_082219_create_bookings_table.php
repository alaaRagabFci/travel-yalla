<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('fullname', 150);
            $table->string('email', 100);
            $table->string('phone', 50);
            $table->integer('duration');
            $table->decimal('amount', 8, 2);
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
