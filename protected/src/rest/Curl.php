<?php

namespace src\rest;

class Curl implements Request
{
    /**
     * @param $url
     * @param $params
     * @return mixed
     */
    public function get($url, $params)
    {
        if ($curl = curl_init()) {

            $params = http_build_query($params);
            $url = $url . ($params != '' ? '?' . $params : '');

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $out = curl_exec($curl);

            curl_close($curl);

            return $out;
        }
    }

    /**
     * @param $url
     * @param $params
     * @return mixed
     */
    public function post($url, $params)
    {
        if ($curl = curl_init()) {

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

            $out = curl_exec($curl);

            curl_close($curl);

            return $out;
        }
    }
}