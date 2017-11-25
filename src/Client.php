<?php

namespace codenixsv\Bittrex;

use codenixsv\Bittrex\Http\HttpClient;

class Client
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Client constructor.
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param $url
     * @param array $headers
     * @return mixed
     */
    public function get($url, $headers = [])
    {

        $response = $this->httpClient->get($url, $headers);

        return $response;
    }

    /**
     * @param $url
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function post($url, $parameters = [], $headers = [])
    {
        $response = $this->httpClient->post($url, $parameters, $headers);

        return $response;
    }
}
