<?php

namespace App\Http\Controllers\Base;

use App\Supports\ExtApi;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function validating(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2'
        ]);
        return ['oke'];
    }

    public function login(Request $request)
    {
        return ExtApi::login($request);
    }

    public function listOpd(Request $request)
    {
        return ExtApi::listOpd();
    }

    public function getOpdById(Request $request)
    {
        return ExtApi::getOpdById($request);
    }

    public function listPegawaiByOpd(Request $request)
    {
        return ExtApi::listPegawaiByOpd($request);
    }

    public function getPegawaiByNip(Request $request)
    {
        return ExtApi::getPegawaiByNip($request);
    }
}
