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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('code', 5);
            $table->string('iso_code', 10);
            $table->string('currency', 50)->nullable();
            $table->string('currency_code', 10)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->comment("Created by user id");
            $table->unsignedBigInteger('modified_by')->nullable(true)->comment("Updated by user id");
            $table->unsignedBigInteger('deleted_by')->nullable(true)->comment("Deleted by User Id");
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
        Schema::dropIfExists('countries');
    }
};
