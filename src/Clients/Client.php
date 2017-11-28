<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

namespace codenixsv\Bittrex\Clients;

use codenixsv\Bittrex\Http\HttpClient;
use codenixsv\Bittrex\Requests\Request;

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
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $response = $this->httpClient->get($request->getUrl(), $request->getHeaders());

        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        $response = $this->httpClient->post($request->getUrl(), $request->getParameters(), $request->getHeaders());

        return $response;
    }
}
