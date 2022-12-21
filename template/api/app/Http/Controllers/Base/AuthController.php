<?php

/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

namespace App\Http\Controllers\Base;

use App\Models\Base\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    /**
     * The request instance.
     *
     * @var Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Create a new token.
     *
     * @param $param
     * @return string
     */
    protected function jwt($param): string
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $param, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            //            'exp' => time() + 60 * 60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * @return array|null[]
     */
    public function refresh(): array
    {
        $auth = $this->request->auth;
        if ($auth) {
            return ['value' => $auth->perm];
        }
        return ['value' => null];
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @return mixed
     */
    public function logout()
    {
        $auth = $this->request->auth;
        try {
            if ($auth) {
                $auth->tokens()->delete();
            }
        } catch (Exception $e) {
        }

        return [
            'condition' => true,
            'message' => 'You have successfully logged out and the token was successfully deleted',
            'results' => [],
        ];
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @return mixed
     * @throws ValidationException
     */
    public function authenticate()
    {
        $this->validate($this->request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Find the user by email
        /** @var User $user */
        $user = User::where('email', $this->request->input('email'))->first();
        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the
            // below respose for now.
            return response()->json([
                'msg' => 'Anda tidak memiliki akses',
                'token' => null,
                'value' => null,
            ], 200);
        }
        // Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $user->password)) {

            $detail = $user->detail;
            $detail['lastAccess'] = date('Y-m-d H:i:s');
            $detail['ip'] = $this->request->ip();
            $user->detail = $detail;

            $param = [
                'id' => $user->id,
                'email' => $user->email,
                'password' => $user->password,
            ];

            if ($user->save()) {
                return response()->json([
                    'msg' => 'OK',
                    'token' => $this->jwt($param),
                    'value' => $user,
                ], 200);
            }
        }

        // Bad Request response
        return response()->json([
            'msg' => 'Email atau Password Salah',
            'token' => null,
            'value' => null,
        ], 200);
    }
}
