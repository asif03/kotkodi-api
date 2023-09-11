<?php

namespace App\Traits;

use Illuminate\Support\Str;
use stdClass;

trait RespondsWithHttpStatus
{
    protected function success($data = [], $status = 200)
    {
        $response = [
            'requestId' => (string)Str::uuid(),
            'responseTime' => microtime(true),
            'code' => $status,
            'hasError' => false,
        ];
        if(is_array($data) && isset($data['message']) && !empty($data['message'])) {
            $response['message'] = $data['message'];
            unset($data['message']);
        }  
        $response['result'] = (is_array($data) || is_object($data)) ? $data : ['status' => is_numeric($data) ? true : $data];
        return response($response, $status);
    }

    protected function failure($errors = [], $status = 422)
    {
        $uuid = (string)Str::uuid();
        $message = (!is_array($errors) && !is_object($errors)) ? $errors : config('constant.failed_common_message');
        $errors = (is_array($errors) || is_object($errors)) ? $errors : null;
        
        return response([
            'requestId' => $uuid,
            'responseTime' => microtime(true),
            'code' => $status,
            'hasError' => true,
            'message' => $message,
            'errors' => is_null($errors) ? new stdClass : $errors,
        ], $status);
    }

    protected function refresh()
    {
        $ttlMinutes = config('constant.ttl_minutes');
        return $this->respondWithTokenForExpiration(auth()->setTTL($ttlMinutes)->refresh());
    }

    protected function respondWithTokenForExpiration($token, $status = 490)
    {
        return response([
            'code' => $status,
            'token' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => auth()->factory()->getTTL() * config('constant.expires_in_time_multiplier'),
        ], $status);
    }

}
