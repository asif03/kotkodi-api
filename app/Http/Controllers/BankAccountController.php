<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountCreateRequest;
use App\Http\Requests\BankAccountUpdateRequest;
use App\Http\Service\BankAccountService;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    public $bankAccountService;

    public function __construct( BankAccountService $bankAccountService )
    {
        $this->bankAccountService = $bankAccountService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/bank-account/list",
     *      tags={"Bank Account"},
     *      summary="Get list of bank account of a logged in user",
     *      description="Returns list of bank account of a logged in user",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"Token": {}}}
     *     )
     */
    public function index()
    {
        $userId = Auth::id();
        return $this->bankAccountService->index( $userId );
    }
    /**
     * @OA\Post(
     *      path="/api/v1/bank-account/create",
     *      tags={"Bank Account"},
     *      summary="Create Bank Account of a logged in user",
     *      description="Add new bank account",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/BankAccount")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Bank Account",
     *          @OA\JsonContent(ref="#/components/schemas/BankAccount")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"Token": {}}}
     * )
     */
    public function create( BankAccountCreateRequest $request )
    {
        $request['user_id'] = Auth::id();

        return $this->bankAccountService->create( $request );
    }

    /**
     * @OA\Put(
     *      path="/api/v1/bank-account/update",
     *      tags={"Bank Account"},
     *      summary="Update bank account",
     *      description="Update bank account",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBankAccount")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBankAccount")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"Token": {}}}
     * )
     */
    public function update( BankAccountUpdateRequest $request )
    {
        return $this->bankAccountService->update( $request );
    }

    /**
     * @OA\Get(
     *      path="/api/v1/bank-account/show/{id}",
     *      tags={"Bank Account"},
     *      summary="Show Bank Account Info",
     *      description="Show Bank Account by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Bank Account id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */
    public function show( $id )
    {
        return $this->bankAccountService->show( $id );
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/bank-account/delete/{id}",
     *      tags={"Bank Account"},
     *      summary="Delete Bank Account by Id",
     *      description="Delete Bank Account by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Bank Account Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */
    public function delete( $id )
    {
        return $this->bankAccountService->delete( $id );
    }
}