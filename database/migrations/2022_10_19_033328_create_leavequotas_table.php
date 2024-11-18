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
        Schema::create('leavequotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('staff_id');
            $table->year('year');
            $table->decimal('default', $precision = 8, $scale = 1);
            $table->decimal('taken', $precision = 8, $scale = 1);
            $table->decimal('balance', $precision = 8, $scale = 1);
            $table->decimal('mc_default', $precision = 8, $scale = 1);
            $table->decimal('mc_taken', $precision = 8, $scale = 1);
            $table->decimal('mc_balance', $precision = 8, $scale = 1);
            $table->integer('maternity');
            $table->integer('paternity');
            $table->boolean('delete_quota');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('staff_id')->references('id')->on('staffs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leavequotas');
    }
};
