<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Service\UserService;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the JWT token",
 *     name="Auth Token",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="Token",
 * )
 */

class UserController extends Controller
{
    use RespondsWithHttpStatus;
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *      path="/api/v1/user/register",
     *      tags={"Users"},
     *      summary="Register a new user",
     *      description="Register a new user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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
     *      )
     * )
     */
    public function register(UserCreateRequest $request)
    {
        return $this->userService->register($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/user/login",
     *      tags={"Users"},
     *      summary="Login to the system",
     *      description="Login to the system",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Login")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Login",
     *          @OA\JsonContent(ref="#/components/schemas/Login")
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
     *      )
     * )
     */
    public function login(UserLoginRequest $request)
    {
        return $this->userService->login($request);
    }

    /**
     * @OA\Post(
     *   path="/api/v1/user/logout",
     *      tags={"Users"},
     *      summary="User Logout",
     *      description="User Logout from the system",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */
    public function logout()
    {
        $forever = true;
        JWTAuth::parseToken()->invalidate($forever);
        return $this->success(['status' => true, 'message' => trans("messages.logout")], Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/user/token-verification",
     *      tags={"Users"},
     *      summary="Token Verification",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TokenVerification")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     */
    public function tokenVerification(Request $request)
    {
        return $this->userService->tokenVerification($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/user/verification-mail-resend",
     *      tags={"Users"},
     *      summary="User Verification mail re-send",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/MailResend")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     */
    public function verificationMailReSend(Request $request)
    {
        return $this->userService->verificationMailReSend($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/user/profile/show",
     *      tags={"Users"},
     *      summary="Show user profile info",
     *      description="Show user profile info",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */
    public function show()
    {
        return $this->userService->show();
    }

    /**
     * @OA\Post(
     *      path="/api/v1/user/profile/update",
     *      tags={"Users"},
     *      summary="Update user profile",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="first_name",
     *                      description="User first name",
     *                      example="Mr",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="last_name",
     *                      description="User last name",
     *                      example="XYZ",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="address_line1",
     *                      description="Address line 1",
     *                      example="Dhaka",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="address_line2",
     *                      description="Address line 2",
     *                      example="Mohakhali",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="address_line3",
     *                      description="Address line 3",
     *                      example="TV Gate",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="phone_country_id",
     *                      description="Phone country id",
     *                      example="1",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="phone",
     *                      description="phone",
     *                      example="01746354",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="gender",
     *                      description="gender",
     *                      example="MALE",
     *                      type="string"
     *                  ),
     *                    @OA\Property(
     *                      property="profile_image",
     *                      type="file",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *              )
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */

    public function profileUpdate(Request $request)
    {
        return $this->userService->profileUpdate($request);
    }
}
