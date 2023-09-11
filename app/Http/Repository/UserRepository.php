<?php

namespace App\Http\Repository;

use App\Mail\UserRegistration;
use App\Models\EmailToken;
use App\Models\File;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
        //
    }

    public static function index($request)
    {
    }

    public static function store($request)
    {
        $request->merge([
            'password' => app('hash')->make($request->password),
        ]);

        $user = User::create($request->all());
        $userId = $user->id;
        $data['token'] = Str::random(config('constant.token_bit_number'));
        $emailTokens = new EmailToken();
        $emailTokens->user_id = $userId;
        $emailTokens->email_to = $user->email;
        $emailTokens->token = $data['token'];
        $emailTokens->expired_date = Carbon::now()->addMinutes(env('URL_EXPIRES_AT'));
        $emailTokens->save();
        $data['deeplink'] = env('APP_URL');
        //Sending Mail
        try {
            Mail::to($user->email)->send(new UserRegistration($data));
        } catch (Exception $e) {
            return $e;
        }

        return $user;
    }

    public static function isTokenExist($token)
    {
        return EmailToken::where('token', $token)->where('expired_date', '>=', Carbon::now())->first(['id', 'user_id', 'email_to', 'token']);
    }

    public static function findById($id)
    {
        return User::find($id);
    }

    public static function findByUserEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public static function verificationMailSend($user)
    {
        $data['token'] = Str::random(config('constant.token_bit_number'));
        $isemailTokenExist = EmailToken::where('email_to', $user->email)->first();
        if ($isemailTokenExist) {
            $emailTokens = $isemailTokenExist;
        } else {
            $emailTokens = new EmailToken();
        }
        $emailTokens->user_id = $user->id;
        $emailTokens->email_to = $user->email;
        $emailTokens->token = $data['token'];
        $emailTokens->expired_date = Carbon::now()->addMinutes(env('URL_EXPIRES_AT'));
        $emailTokens->save();

        $data['deeplink'] = env('APP_URL');
        //Sending Mail
        Mail::to($user->email)->send(new UserRegistration($data));

        return true;
    }

    public static function show()
    {

        return auth()->user();
    }
    public static function update($request)
    {
        $user = auth()->user();
        $userId = $user->id;
        if ($request->has('first_name')) {
            $user->first_name = $request->first_name;
        }

        if ($request->has('last_name')) {
            $user->last_name = $request->last_name;
        }

        $user->modified_by = $userId;
        $user->update();

        $userInfo = UserInfo::where('user_id', $user->id)->first();
        if (!$userInfo) {
            $userInfo = new UserInfo();
            $userInfo->user_id = $userId;
        }

        if ($request->has('address_line1')) {
            $userInfo->address_line1 = $request->address_line1;
        }
        if ($request->has('address_line2')) {
            $userInfo->address_line2 = $request->address_line2;
        }
        if ($request->has('address_line3')) {
            $userInfo->address_line3 = $request->address_line3;
        }

        if ($request->has('phone_country_id')) {
            $userInfo->phone_country_id = $request->phone_country_id;
        }
        if ($request->has('phone')) {
            $userInfo->phone = $request->phone;
        }

        if ($request->has('gender')) {
            $userInfo->gender = $request->gender;
        }

        if ($request->has('profile_image')) {
            $profile_image = $request->file('profile_image');
            $uniqueName = md5($profile_image->getClientOriginalName() . time()) . '.' . $profile_image->extension();
            $file = env('FILE_PATH_PROFILE') . $uniqueName;
            if (!file_exists(env('FILE_PATH_PROFILE'))) {
                mkdir(env('FILE_PATH_PROFILE'), 0777, true);
            }
            $contents = file_get_contents($profile_image);
            file_put_contents($file, $contents);
            $uploaded_file = new UploadedFile($file, $uniqueName);
            $file_1 = new File([
                'file_type' => 'test',
                'file_name' => $uniqueName,
                'extension' => $uploaded_file->extension(),
                'path' => env('FILE_PATH_PROFILE') .
                $uniqueName,
                'created_by' => $userId,
            ]);

            $existFile = File::where('file_name', '=', $userInfo->image)->first();

            if ($existFile) {
                unlink(env('FILE_PATH_PROFILE') . $userInfo->image);
                $userInfo->files()->update($file_1->toArray());
            } else {
                $userInfo->files()->create($file_1->toArray());
                $userInfo->image = $userInfo->files[0]->file_name;
            }

        }
        $userInfo->save();
        return true;
    }
}
