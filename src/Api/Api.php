<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Api;

use Codenixsv\BittrexApi\Message\ResponseTransformer;
use Exception;
use GuzzleHttp\Client;

/**
 * Class Api
 * @package Codenixsv\BittrexApi\Api
 */
class Api
{
    /** @var Client */
    protected $client;

    /** @var string */
    private $version = 'v1.1';

    /** @var ResponseTransformer */
    protected $transformer;

    /**
     * Api constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->transformer = new ResponseTransformer();
    }

    /**
     * @param string $uri
     * @param array $query
     * @return array
     * @throws Exception
     */
    public function get(string $uri, array $query = []): array
    {
        $response = $this->client->request('GET', '/api/' . $this->version
            . $uri, ['query' => $query]);

        return $this->transformer->transform($response);
    }
}
