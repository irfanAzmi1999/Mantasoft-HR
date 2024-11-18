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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            
            $table->unsignedBigInteger('overtimeApplication_id')->nullable();
            $table->date('curentDate')->nullable();
            $table->time('clockedTime_in')->nullable();
            $table->time('clockedTime_out')->nullable();
            $table->string('location_in')->nullable();
            $table->string('location_out')->nullable();
            $table->string('provePhoto')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            $table->foreign('overtimeApplication_id')
            ->references('id')
            ->on('overtime_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('overtimes');
    }
};
