<?php

namespace src\rest;

class FileGet implements Request
{
    /**
     * @param $url
     * @param $params
     * @return bool|string
     */
    public function get($url, $params)
    {
        $params = http_build_query($params);
        return file_get_contents($url . ($params != '' ? '?' . $params : ''));
    }

    /**
     * @param $url
     * @param $params
     * @return bool|string
     */
    public function post($url, $params)
    {
        $params = http_build_query($params);
        $options = [
            'http' => [
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'method' => 'POST',
                'content' => $params
            ]
        ];
        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);
    }

    /**
     * @param $url
     * @param $file
     * @return bool|string
     */
    public function postFile($url, $file)
    {
        $boundary = '---------------------' . substr(md5(rand(0, 32000)), 0, 10);

        $postData = '';
        $postData .= '--' . $boundary . "\n";
        $postData .= 'Content-Disposition: form-data; name="photo"; filename="' . basename($file) . '"' . "\n";
        $postData .= 'Content-Type: text/xml' . "\n";
        $postData .= 'Content-Transfer-Encoding: binary' . "\n\n";
        $postData .= file_get_contents($file) . "\n";
        $postData .= '--' . $boundary . "\n";

        $options = [
            'http' => [
                'header' => 'Content-Type: multipart/form-data; boundary=' . $boundary,
                'method' => 'POST',
                'content' => $postData
            ]
        ];

        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);
    }
}