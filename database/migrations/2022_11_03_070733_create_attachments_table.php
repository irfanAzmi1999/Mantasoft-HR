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
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('leave_id');
            $table->string('name');
            $table->string('type');
            $table->integer('size');
            $table->boolean('delete_attachment');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('leave_id')->references('id')->on('leavedetails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
};
