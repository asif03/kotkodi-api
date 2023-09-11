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
        Schema::create( 'bank_accounts', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'user_id' )->comment( "whom bank account" );
            $table->string( 'account_type', 50 );
            $table->string( 'account_no', 20 );
            $table->string( 'account_title', 50 );
            $table->string( 'bank_name', 50 );
            $table->string( 'branch_name', 50 );
            $table->string( 'swift_code', 20 );
            $table->boolean( 'is_active' )->default( true );
            $table->unsignedBigInteger( 'updated_by' )->nullable( true )->comment( "Updated by user id" );
            $table->unsignedBigInteger( 'modified_by' )->nullable( true )->comment( "Deleted by user id" );
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )
                ->onUpdate( 'cascade' )->onDelete( 'cascade' );
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
        Schema::dropIfExists( 'bank_accounts' );
    }
};