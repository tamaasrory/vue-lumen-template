<?php
/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

namespace App\Http\Controllers\Base;

use App\Models\Base\Role;
use App\Supports\ExtApi;
use App\Models\Base\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class ExtAuthController extends BaseController
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
            # 'exp' => time() + 60 * 60 // Expiration time
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
     * @throws ValidationException
     */
    public function authenticate()
    {
        $this->validate($this->request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // percobaan login ke sinergi
        $login = ExtApi::login($this->request);

        if ($login['result']) { // login sinergi berhasil dan user ditemukan

            // cek apakah user telah terdaftar di tabel user
            /** @var User $findUser */
            $findUser = User::find($login['nip']);
            $dataUser = null;

            if ($findUser) { // sudah terdaftar dalam tabel user
                // rekam ip dan waktu akses
                $detail = $findUser->detail;
                $detail['lastAccess'] = date('Y-m-d H:i:s');
                $detail['ip'] = $this->request->ip();
                $findUser->detail = $detail;

                // set role yang sesuai dengan jabatan
                $this->giveRole($findUser, $login['kode_jabatan']);
                $findUser->save();
                $dataUser = $findUser;
            } else { // belum terdaftar dalam tabel user
                // tambahkan user ke tabel user
                $newUser = new User();
                $newUser->id = $login['nip'];
                $newUser->name = $login['nama_jabatan'];

                // rekam ip dan waktu akses
                $detail = [];
                $detail['lastAccess'] = date('Y-m-d H:i:s');
                $detail['ip'] = $this->request->ip();
                $newUser->detail = $detail;
                $newUser->save();

                // set role yang sesuai dengan jabatan
                /** @var User $newUser */
                $newUser = User::find($login['nip']);
                $this->giveRole($newUser, $login['kode_jabatan']);
                $dataUser = $newUser;
            }

            // paramater untuk pembuatan token jwt
            $param = [
                'id' => $login['nip'],
                'kdj' => $login['kode_jabatan']
            ];

            return response()->json([
                'token' => $this->jwt($param), // buat token untuk user ini
                'value' => $dataUser,
            ], 200);

        } else {  // login sinergi tidak berhasil atau user tidak ditemukan

            // cari user di tabel user langsung
            /** @var User $user */
            $user = User::where('email', $this->request->input('username'))
                ->first();

            if (!$user) { // bila user tidak juga ditemukan di tabel user
                return response()->json([
                    'msg' => 'Username atau Password Salah',
                    'token' => null,
                    'value' => null,
                ], 200);
            }

            // user ditemukan dan cek passwordnya
            if (Hash::check($this->request->input('password'), $user->password)) {
                // password sesuai
                // rekam ip dan waktu akses
                $detail = $user->detail;
                $detail['lastAccess'] = date('Y-m-d H:i:s');
                $detail['ip'] = $this->request->ip();
                $user->detail = $detail;

                // paramater untuk pembuatan token jwt
                $param = [
                    'id' => $user->id,
                    'kdj' => '-'
                ];

                if ($user->save()) {
                    return response()->json([
                        'token' => $this->jwt($param), // buat token untuk user ini
                        'value' => $user,
                    ], 200);
                }
            }
        }

        return response()->json([
            'msg' => 'Username atau Password Salah',
            'token' => null,
            'value' => null,
        ], 200);
    }

    /**
     * @param User $user
     * @param $kode_jabatan
     */
    public function giveRole(User $user, $kode_jabatan)
    {
        // cari role yang sesuai dengan kode jabatan
        $findRole = Role::whereRaw("label like '%\"{$kode_jabatan}\"%'")->first();
        if (!$findRole) {
            /*
             * bila kode jabatan tidak terdaftar di label tabel roles  maka akan
             * diberikan hak akses default yaitu "Staff"
             */
            $findRole = Role::findByName('Staff');
        }

        // Log::info($user);
        // Log::info($findRole);

        // beri hak akses ke user
        $user->assignRole([$findRole->id]);
        $user->save();
    }
}
