<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
          $table->id();

        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')
             ->references('id')
             ->on('users');

        $table->date('curentDate')->nullable();

        $table->double('latitude_in')->nullable();
        $table->double('longitude_in')->nullable();
        $table->string('location_in')->nullable();
        $table->time('time_in')->nullable();
        $table->string('photo_in')->nullable();
        $table->string('reasonLate_in')->nullable();

        $table->double('latitude_out')->nullable();
        $table->double('longitude_out')->nullable();
        $table->string('location_out')->nullable();
        $table->time('time_out')->nullable();
        $table->string('photo_out')->nullable();
        $table->string('reason_out')->nullable();

        $table->rememberToken();
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
        Schema::dropIfExists('attendances');
    }
};
