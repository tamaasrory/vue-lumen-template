<?php

namespace App\Supports;

use Illuminate\Http\Request;

class ExtApi
{
    /**
     * Login ke sinergi
     *
     * @param Request $request
     * @return array|bool|false[]|mixed|string
     */
    public static function login(Request $request)
    {
        $curl = new Curl();
        $tmp = $curl->route('api_login')
            ->method('GET')
            ->addField($request->all())
            ->run();

        if (!isset($tmp['error']) && isset($tmp['result'])) {
            if ($tmp['result'] === 'verified') {

                $request->request->add(['nip' => $tmp['nip']]);
                $pegawai = self::getPegawaiByNip($request);

                if ($pegawai['result']) {
                    $tmp['nama_pegawai'] = $pegawai['nama_pegawai'];
                    return $tmp;
                }

                return $tmp;
            }
        }

        return ['result' => false];
    }

    /**
     * Get List OPD
     *
     * @return array|bool|mixed|string
     */
    public static function listOpd()
    {
        $curl = new Curl();
        $tmp = $curl->route('api_opd')
            ->method('GET')
            ->addField(['all' => 'yes'])
            ->run();

        if (!isset($tmp['error'])) {
            return $tmp;
        }

        return ['result' => false];
    }

    /**
     * Get OPD by id OPD
     *
     * @param Request $request
     * @return array|bool|mixed|string
     */
    public static function getOpdById(Request $request)
    {
        $curl = new Curl();
        $tmp = $curl->route('api_opd')
            ->method('GET')
            ->addField(['id_opd' => $request->input('id_opd')])
            ->run();

        if (!isset($tmp['error']) && is_array($tmp)) {
            return $tmp[0];
        }
        return ['result' => false];
    }

    /**
     * Get List Pegawai by id OPD
     *
     * @param Request $request
     * @return array|bool|mixed|string
     */
    public static function listPegawaiByOpd(Request $request)
    {
        $id_opd = $request->input('id_opd');
        $curl = new Curl();
        $tmp = $curl->route('api_pegawai')
            ->method('GET')
            ->addField(['id_opd' => $id_opd])
            ->run();

        if (!isset($tmp['error']) && $tmp) {
            return array_values(array_filter($tmp, function ($data) use ($id_opd) {
                if ((((int)substr($data['kode_jabatan'], 0, 2)) == $id_opd) || ($id_opd == '-1')) {
                    return $data;
                }
            }));
        }
        return [];
    }

    /**
     * Get Pegawai by NIP
     *
     * @param Request $request
     * @return array|bool|mixed|string
     */
    public static function getPegawaiByNip(Request $request)
    {
        $curl = new Curl();
        $tmp = $curl->route('api_pegawai')
            ->method('GET')
            ->addField(['nip' => $request->input('nip')])
            ->run();

        if (!isset($tmp['error']) && !isset($tmp['result'])) {
            $tmp['result'] = true;
            return $tmp;
        }

        return ['result' => false];
    }
}
