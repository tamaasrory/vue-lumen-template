<?php
/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

namespace App\Http\Middleware;

use App\Models\Base\User;
use App\Supports\ExtApi;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class ExtJwt
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken(); // ambil token dari header paramater

        if (!$token) {
            // Unauthorized response if token not there
            return response()->json(['msg' => 'Token not provided.'], 401);
        }

        try {
            // urai token
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json(['msg' => 'Provided token is expired.'], 400);
        } catch (Exception $e) {
            return response()->json(['msg' => 'An error while decoding token.'], 400);
        }

        $result = null;
        $sub = $credentials->sub;
        if ($sub->kdj != '-') { // hanya pegawai yang terdaftar di sinergi
            // tambahkan paramater baru yaitu nip ke request
            $request->request->add(['nip' => $sub->id]);
            // get data user yang memiliki token ini, dari sinergi
            $result = ExtApi::getPegawaiByNip($request);
            if (!$result['result']) {
                return response()->json([
                    'msg' => 'Session anda tidak valid, silahkan login ulang'],
                    400);
            }
        }

        /** @var User $resultLocal */
        $resultLocal = User::find($sub->id); // cari data di tabel user
        if (!$resultLocal) { // bila tidak ditemukan
            return response()->json([
                'msg' => 'User tidak ditemukan',
                'token' => null,
                'value' => null,
            ], 200);
        }

        if ($sub->kdj != '-') { // bila data tidak ditemukan
            if ($sub->kdj != $result['kode_jabatan']) {
                return response()->json([
                    'msg' => 'Session anda tidak valid, silahkan login ulang'],
                    400);
            }
        }

        if ($sub->kdj != '-') {
            $resultLocal->sinergi = $result;
        }
        // Now let's put the user in the request class so that you can grab it from there
        // bila user ditemukan maka simpan data user ke dalam resquest,
        // supaya bisa di pakai bila kebutuhan authorization di controller
        $request->auth = $resultLocal;

        return $next($request);
    }
}
