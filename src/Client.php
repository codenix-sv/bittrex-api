<?php

namespace codenixsv\Bittrex;

use codenixsv\Bittrex\Http\HttpClient;

/**
 * Class Client
 * @package codenixsv\Bittrex
 */
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
     * @param string $url
     * @param array $headers
     * @return mixed
     */
    public function get(string $url, array $headers = [])
    {

        $response = $this->httpClient->get($url, $headers);

        return $response;
    }

    /**
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function post(string $url, array $parameters = [], array $headers = [])
    {
        $response = $this->httpClient->post($url, $parameters, $headers);

        return $response;
    }
}
