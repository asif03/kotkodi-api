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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_name', 100);
            $table->string('currency_code', 10);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable(true)->comment("Created by user id");
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
        Schema::dropIfExists('currencies');
    }
};