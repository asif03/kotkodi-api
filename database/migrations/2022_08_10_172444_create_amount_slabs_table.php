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
        Schema::create('amount_slabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedDouble("start_amount", 15, 2);
            $table->unsignedDouble("end_amount", 15, 2);
            $table->unsignedDouble("backer_fixed_gain", 15, 2)->default(0);
            $table->unsignedDouble("backer_percent_gain", 15, 2)->default(0);
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
        Schema::dropIfExists('amount_slabs');
    }
};
