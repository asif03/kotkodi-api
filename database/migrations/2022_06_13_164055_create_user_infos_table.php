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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('address_line3')->nullable();
            $table->unsignedBigInteger("phone_country_id")->nullable(true);
            $table->string('phone', 30)->nullable();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable(true)->comment("Updated by user id");
            $table->unsignedBigInteger('modified_by')->nullable(true)->comment("Deleted by user id");
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('phone_country_id')->references('id')->on('countries');
            $table->softDeletes();
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
        Schema::dropIfExists('user_infos');
    }
};
