<?php

namespace App\Supports;

class Curl
{

    public $ch = null;
    public $BASE_URL = 'https://subdomain.yourdomain.com/';

    public $headers = array();

    public function __construct()
    {
        $this->setUpOrReset();
    }

    /**
     * Setup curl or reset curl for handling next request
     */
    public function setUpOrReset()
    {
        $this->ch = null;
        $this->headers = [];
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');

        $this->addHeader([
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
    }

    /**
     * settting api key
     * @param $api_key
     */
    public function setAuth($api_key)
    {
        $this->setUpOrReset();// reset curl config
        $this->addHeader('Authorization: Basic ' . base64_encode($api_key . ':'));
    }

    /**
     * tujuan api url
     * @param $to
     * @return $this
     */
    public function route($to)
    {
        curl_setopt($this->ch, CURLOPT_URL, $this->BASE_URL . $to);
        return $this;
    }

    /**
     * add paramater fields
     * @param $fields
     * @return $this
     */
    public function addField($fields)
    {
        $fields = json_encode(is_array($fields) ? $fields : [$fields]);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $fields);
        return $this;
    }

    /**
     * add header
     * @param $header
     * @return $this
     */
    public function addHeader($header)
    {
        if (is_array($header)) {
            foreach ($header as $value) {
                $this->headers[] = $value;
            }
        } else {
            $this->headers[] = $header;
        }
        return $this;
    }

    /**
     * set method to request iris API
     * @param $type
     * @return $this
     */
    public function method($type)
    {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $type);
        return $this;
    }

    /**
     * jalankan perintah curl
     * @return array|bool|mixed|string
     */
    public function run()
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
        $result = curl_exec($this->ch);
        if (curl_errno($this->ch)) {
            return ['error'=>curl_error($this->ch)];
        }

        curl_close($this->ch);

        $tmp = json_decode($result, true);

        if ($tmp != 'null') {
            if (is_array($tmp)) {
                return $tmp;
            }
        } else {
            return $result;
        }

        return $result;
    }

}
