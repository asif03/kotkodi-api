<?php

namespace App\Http\Service;

use App\Http\Repository\CountryRepository;
use App\Http\Repository\UserRepository;
use App\Http\Resources\UserResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    use RespondsWithHttpStatus;
    public function __construct()
    {
        $this->guard = "api";
    }

    /**
     * @OA\Schema(
     *      schema="User",
     *      title="Register user request",
     *      description="Register user request body",
     *      type="object",
     *      required={"first_name", "last_name", "email", "user_name", "password", "password_confirmation"},
     *      @OA\Property(
     *          property="first_name",
     *          description="First name of user",
     *          example="MD",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="last_name",
     *          description="Last name of user",
     *          example="Rafiq",
     *          type="string"
     *      ),
     *     @OA\Property(
     *          property="email",
     *          description="Email ID of user",
     *          example="mdrafiq@gmail.com",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="user_name",
     *          description="User name of user",
     *          example="mdrafiq",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="password",
     *          description="Password of the user",
     *          example="12345678",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="password_confirmation",
     *          description="Confirm password",
     *          example="12345678",
     *          type="string"
     *      )
     * )
     */
    public function register($request)
    {
        $user = UserRepository::store($request);
        if ($user) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }
    }
    /**
     * @OA\Schema(
     *      schema="Login",
     *      title="Login",
     *      description="Login request body",
     *      type="object",
     *      required={"email","password"},
     *      @OA\Property(
     *          property="email",
     *          description="Email of user",
     *          example="mdrafiq@gmail.com",
     *          type="string"
     *      ),
     *           @OA\Property(
     *          property="password",
     *          description="Password of the user",
     *          example="12345678",
     *          type="string"
     *      )
     * )
     */
    public function login($request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->failure('Unauthorized user', Response::HTTP_UNAUTHORIZED);
        }

        $user = UserRepository::findByUserEmail($request->email);
        if ($user->is_active == 1) {
            return $this->success($this->respondWithToken($token, new UserResource($user)), Response::HTTP_OK);
        } else {
            return $this->failure(trans('messages.loginUserVerify'), Response::HTTP_UNAUTHORIZED);
        }
        //return $this->success($this->respondWithToken($token, null), Response::HTTP_OK);
    }

    public function guard()
    {
        return Auth::guard();
    }
    public function respondWithToken($token, $user)
    {
        return [
            'token' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => auth($this->guard)->factory()->getTTL() * 60,
            'user' => $user,
        ];
    }

    /**
     * @OA\Schema(
     *      schema="TokenVerification",
     *      title="Token Verification",
     *      description="Verify Token",
     *      type="object",
     *      required={"token"},
     *      @OA\Property(
     *          property="token",
     *          description="User Token",
     *          example="xxxxxxxxx",
     *          type="string"
     *      )
     * )
     * */
    public function tokenVerification($request)
    {

        $token = $request->token;
        $isTokenExist = UserRepository::isTokenExist($token);
        if (!empty($isTokenExist)) {
            $user = UserRepository::findById($isTokenExist->user_id);
            $accessToken = JWTAuth::fromUser($user);
            $isTokenExist->token = null;
            $isTokenExist->save();
            $user->is_active = 1;
            $user->save();
            $data['user'] = $user;
            $data['accessToken'] = $accessToken;
            return $this->success($this->respondWithToken($data['accessToken'], new UserResource($data['user'])), Response::HTTP_OK);
        } else {
            return $this->failure(trans("messages.invalidToken"), Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @OA\Schema(
     *      schema="MailResend",
     *      title="Verification mail resend",
     *      description="Verification mail resend",
     *      type="object",
     *      required={"email"},
     *      @OA\Property(
     *          property="email",
     *          description="User email",
     *          example="mdrafiq10015@gmail.com",
     *          type="string"
     *      )
     * )
     * */

    public function verificationMailReSend(Request $request)
    {
        $user = UserRepository::findByUserEmail($request->email);
        if (!$user) {
            return $this->failure(trans("messages.notFound"), Response::HTTP_NOT_FOUND);
        }

        $isSend = UserRepository::verificationMailSend($user);
        return $this->success(trans('messages.success'), Response::HTTP_OK);
    }

    public function show()
    {
        $user = UserRepository::show();
        return $this->success(new UserResource($user), Response::HTTP_OK);

    }

    public function profileUpdate($request)
    {
        if ($request->has('phone_country_id')) {
            $country = CountryRepository::findById($request->phone_country_id);

            if (!$country) {
                return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
            }
        }

        $isUpdate = UserRepository::update($request);
        if ($isUpdate) {
            return $this->success(trans('messages.update'), Response::HTTP_OK);
        }

    }
}
