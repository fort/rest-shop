<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth as JWTA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AccountController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        /*
            [auth:protected] => Tymon\JWTAuth\Providers\Auth\Illuminate Object
                [auth:protected] => Tymon\JWTAuth\JWTGuard Object
                    ...
                    [provider:protected] => Illuminate\Auth\EloquentUserProvider Object
                        public function setModel($model)
        */
        $provider = Auth::getProvider()->setModel(\App\Models\Admin\User::class);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username'    => 'required|max:20',
            'password' => 'required',
        ]);

        try {
            $credentials = $request->only('username', 'password');
            if (! $token = $this->jwt->attempt($request->only('username', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'));
    }
}
