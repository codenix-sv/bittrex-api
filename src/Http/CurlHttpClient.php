<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

namespace codenixsv\Bittrex\Http;

use codenixsv\Bittrex\Exceptions\CurlException;

/**
 * Class CurlHttpClient
 * @package codenixsv\Bittrex\Http
 */
class CurlHttpClient implements HttpClient
{
    /**
     * @param $url
     * @param array $headers
     * @return mixed
     * @throws CurlException
     */
    public function get($url, array $headers = [])
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
    public function post($url, array $parameters = [], array $headers = [])
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
