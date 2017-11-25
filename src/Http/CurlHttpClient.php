<?php

namespace codenixsv\Bittrex\Http;

use codenixsv\Bittrex\Exceptions\CurlException;

class CurlHttpClient implements HttpClient
{
    /**
     * @param $url
     * @param array $headers
     * @return mixed
     * @throws CurlException
     */
    public function get($url, $headers = [])
    {
        $ch = curl_init($url);
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        $this->checkExceptions($ch);

        return $response;
    }

    /**
     * @param $url
     * @param array $parameters
     * @param array $headers
     * @return mixed
     * @throws CurlException
     */
    public function post($url, $parameters = [], $headers = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if (!empty($parameters)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        }

        $response = curl_exec($ch);

        $this->checkExceptions($ch);

        curl_close($ch);

        return $response;
    }

    /**
     * @param $ch
     * @throws CurlException
     */
    private function checkExceptions($ch)
    {
        if (curl_errno($ch)) {
            $errorMessage = curl_error($ch);
            curl_close($ch);
            throw new CurlException($errorMessage);
        }
    }
}
