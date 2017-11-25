<?php

namespace codenixsv\Bittrex\Http;

/**
 * Interface HttpClient
 * @package codenixsv\Bittrex\Http
 */
interface HttpClient
{
    /**
     * @param $url
     * @param array $headers
     * @return mixed
     */
    public function get($url, array $headers = []);

    /**
     * @param $url
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function post($url, array $parameters = [], array $headers = []);
}
