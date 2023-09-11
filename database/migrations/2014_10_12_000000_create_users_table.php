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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email', 40)->unique();
            $table->string('user_name', 40)->unique();
            $table->string('password', 100)->nullable();
            $table->string('status', 50)->default("USER")->comment('Admin: ADMIN, Project Owner: PROJECT_OWNER, Backer: BACKER, User: USER, Visitor: VISITOR');
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('users');
    }
};
