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
        Schema::create('leavedetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('leavetype_id');
            $table->unsignedBigInteger('emergencytype_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('approver_id')->nullable();
            $table->dateTime('apply_date');
            $table->integer('half_day');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('date_leave', $precision = 8, $scale = 1);
            $table->longText('staff_remarks');
            $table->longText('approver_remarks')->nullable();
            $table->boolean('delete_leavedetail');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('staff_id')->references('id')->on('staffs');
            $table->foreign('leavetype_id')->references('id')->on('leavetypes');
            $table->foreign('emergencytype_id')->references('id')->on('emergencytypes');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('approver_id')->references('superior_id')->on('staffs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leavedetails');
    }
};
