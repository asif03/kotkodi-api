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
        Schema::create( 'categories', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'category_name', 50 );
            $table->boolean( 'is_active' )->default( true );
            $table->unsignedBigInteger( 'updated_by' )->nullable( true )->comment( "Updated by user id" );
            $table->unsignedBigInteger( 'modified_by' )->nullable( true )->comment( "Deleted by user id" );
            $table->softDeletes();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'categories' );
    }
};