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
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->unsignedBigInteger('blood_id')->nullable();
            $table->string('phone')->unique();
            $table->longText('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('pob')->nullable();
            $table->string('gender')->nullable();
            $table->decimal('height', $precision = 8, $scale = 1)->nullable();
            $table->decimal('weight', $precision = 8, $scale = 1)->nullable();
            $table->string('nokp_new')->nullable();
            $table->string('nokp_old')->nullable();
            $table->string('epf')->nullable();
            $table->string('tax')->nullable();
            $table->string('image')->nullable();
            $table->boolean('delete_profile');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('nationality_id')->references('id')->on('nationalities');
            $table->foreign('blood_id')->references('id')->on('bloods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
