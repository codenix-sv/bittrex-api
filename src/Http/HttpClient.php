<?php

namespace codenixsv\Bittrex\Http;

interface HttpClient
{
    /**
     * @param $url
     * @param array $headers
     * @return mixed
     */
    public function get($url, $headers = []);

    /**
     * @param $url
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function post($url, $parameters = [], $headers = []);
}
