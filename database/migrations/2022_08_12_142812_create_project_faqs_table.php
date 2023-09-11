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
        Schema::create('project_faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->text('question');
            $table->longText('answer');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->comment("Created by user id");
            $table->unsignedBigInteger('updated_by')->nullable(true)->comment("Updated by user id");
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
        Schema::dropIfExists('project_faqs');
    }
};