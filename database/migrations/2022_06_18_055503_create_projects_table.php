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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->mediumText('project_subtitle')->nullable(true);
            $table->string('project_no', 20);
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("country_id")->comment("project location");
            $table->dateTime('project_start_date')->nullable(true);
            $table->dateTime('project_end_date')->nullable(true);
            $table->dateTime('campaign_start_date')->nullable(true);
            $table->dateTime('campaign_end_date')->nullable(true);
            $table->enum('phase', ['INIT', 'CAMPAIGN', 'PENDING', 'LIVE', 'COMPLETE', 'FAILED'])->default('INIT');
            $table->string('intro_video')->nullable(true);
            $table->binary('story')->nullable(true);
            $table->binary('risks')->nullable(true);
            $table->unsignedDouble("target_amount", 15, 2)->default(0);
            $table->unsignedDouble("min_donation_amount", 15, 2)->default(0);
            $table->unsignedBigInteger("currency_id")->nullable(true);
            $table->string('donation_type', 20)->comment('fixed,percentage,mixed')->nullable(true);
            $table->boolean('is_approved')->default(false);
            $table->unsignedBigInteger('created_by')->comment("Created by user id")->nullable(true);
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
        Schema::dropIfExists('projects');
    }
};
