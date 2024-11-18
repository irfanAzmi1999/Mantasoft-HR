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
        Schema::create('educations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id');
            $table->string('school_name')->nullable();
            $table->year('year_from')->nullable();
            $table->year('year_to')->nullable();
            $table->string('achievement')->nullable();
            $table->string('result')->nullable();
            $table->boolean('delete_education');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('profile_id')->references('id')->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educations');
    }
};
