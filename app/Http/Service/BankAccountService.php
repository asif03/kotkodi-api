<?php

namespace App\Http\Service;

use App\Http\Repository\BankAccountRepository;
use App\Http\Resources\BankAccountCollection;
use App\Http\Resources\BankAccountResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BankAccountService
{
    use RespondsWithHttpStatus;

    public function index($userId)
    {
        $bankAccount = BankAccountRepository::index($userId);
        return $this->success(new BankAccountCollection($bankAccount), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="BankAccount",
     *      title="BankA ccount",
     *      description="Bank Account create request body",
     *      type="object",
     *      required={"account_type", "account_no", "account_title", "bank_name", "branch_name", "swift_code"},
     *       @OA\Property(
     *          property="account_type",
     *          description="Account type",
     *          example="Savings",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="account_no",
     *          description="Bank account number",
     *          example="1234567, CD-123456",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="account_title",
     *          description="Name of the account",
     *          example="Asif, Aman",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="bank_name",
     *          description="Name of the bank",
     *          example="Pubali Bank Ltd",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="branch_name",
     *          description="Name of the branch",
     *          example="Main branch",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="swift_code",
     *          description="Swift code of the bank",
     *          example="PBHLH",
     *          type="string"
     *      )
     * )
     */
    public function create($request)
    {
        $country = BankAccountRepository::store($request);

        if ($country) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }

    }

    /**
     * @OA\Schema(
     *      schema="UpdateBankAccount",
     *      title="Update Bank Account",
     *      description="Bank Account update request body",
     *      type="object",
     *      required={"id", "account_type", "account_no", "account_title", "bank_name", "branch_name", "swift_code"},
     *      @OA\Property(
     *          property="id",
     *          description="ID of bank account",
     *          example="2",
     *          type="integer"
     *      ),
     *       @OA\Property(
     *          property="account_type",
     *          description="Account type",
     *          example="Savings",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="account_no",
     *          description="Bank account number",
     *          example="1234567, CD-123456",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="account_title",
     *          description="Name of the account",
     *          example="Asif, Aman",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="bank_name",
     *          description="Name of the bank",
     *          example="Pubali Bank Ltd",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="branch_name",
     *          description="Name of the branch",
     *          example="Main branch",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="swift_code",
     *          description="Swift code of the bank",
     *          example="PBHLH",
     *          type="string"
     *      )
     * )
     */
    public function update($request)
    {
        $bankAccount = BankAccountRepository::findById($request->id);

        if (!$bankAccount) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($bankAccount->user_id != Auth::id()) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($bankAccount) {
            $isUpdate = BankAccountRepository::update($request, $bankAccount);

            if ($isUpdate) {
                return $this->success(trans('messages.update'), Response::HTTP_OK);
            }

        }

    }

    public function show($id)
    {
        $bankAccount = BankAccountRepository::findById($id);

        if (!$bankAccount) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($bankAccount->user_id != Auth::id()) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new BankAccountResource($bankAccount), Response::HTTP_OK);
    }

    public function delete($id)
    {
        $bankAccount = BankAccountRepository::findById($id);

        if (!$bankAccount) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($bankAccount->user_id != Auth::id()) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(BankAccountRepository::delete($bankAccount));
    }

}