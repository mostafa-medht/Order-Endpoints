<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    use GeneralTrait;

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            // login
            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('user-api')->attempt($credentials);

            if (!$token) {
                return $this->returnError('', 'Invalid Credentials');
            }

            $user = Auth::guard('user-api')->user();
            $user->api_token = $token;
            // return token
            return $this->returnData('user', $user);
        } catch (\Exception $exception) {
            return $this->returnError($exception->getCode(), $exception->getMessage());
        }
    } // end of login

    public function logout(Request $request)
    {
        $token = $request->header('auth-token');
        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate();
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $exception) {
                return $this->returnError('', 'some thing went wrong');
            }
            return $this->returnSuccessMessage('Logged out Sussessfully');
        } else {
            return $this->returnError('', 'some thing went wrong');
        }
    } // end of logout
} // end of controller
