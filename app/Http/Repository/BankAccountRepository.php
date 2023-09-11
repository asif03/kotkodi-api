<?php

namespace App\Http\Repository;

use App\Models\BankAccount;

class BankAccountRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function index( $userId )
    {
        return BankAccount::where( 'user_id', $userId )->get();
    }

    public static function store( $request )
    {
        return BankAccount::create( $request->all() );
    }

    public static function update( $request, $bankAccount )
    {

        if ( $request->has( 'user_id' ) ) {
            $bankAccount->user_id = $request->user_id;
        }

        if ( $request->has( 'account_type' ) ) {
            $bankAccount->account_type = $request->account_type;
        }

        if ( $request->has( 'account_no' ) ) {
            $bankAccount->account_no = $request->account_no;
        }

        if ( $request->has( 'account_title' ) ) {
            $bankAccount->account_title = $request->account_title;
        }

        if ( $request->has( 'bank_name' ) ) {
            $bankAccount->bank_name = $request->bank_name;
        }

        if ( $request->has( 'branch_name' ) ) {
            $bankAccount->branch_name = $request->branch_name;
        }

        if ( $request->has( 'swift_code' ) ) {
            $bankAccount->swift_code = $request->swift_code;
        }

        if ( $request->has( 'is_active' ) ) {
            $bankAccount->is_active = $request->is_active == 1 ? 1 : 0;
        }

        return $bankAccount->update();
    }

    public static function show( $id )
    {
        $bankAccount = BankAccount::findOrFail( $id );

        return $bankAccount;
    }

    public static function delete( $bankAccount )
    {
        return $bankAccount->delete();
    }

    public static function findById( $id )
    {
        return BankAccount::find( $id );
    }

}