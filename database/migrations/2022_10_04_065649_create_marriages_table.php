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
        Schema::create('marriages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('marital_id');
            $table->date('marriage_date')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_job')->nullable();
            $table->string('spouse_company')->nullable();
            $table->boolean('delete_marriage');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('marital_id')->references('id')->on('maritals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marriages');
    }
};
