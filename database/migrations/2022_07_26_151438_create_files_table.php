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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file_type', 30);
            $table->string('file_name', 150);
            $table->string('extension', 10);
            $table->string('path', 100);
            $table->string('fileable_type', 80);
            $table->bigInteger('fileable_id')->length(20);
            $table->unsignedBigInteger('created_by')->comment("Created by User");
            $table->unsignedBigInteger('updated_by')->nullable(true)->comment("Updated by User Id");
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
        Schema::dropIfExists('files');
    }
};
