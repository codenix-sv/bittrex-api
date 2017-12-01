<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

namespace codenixsv\Bittrex\Requests\Managers;

use codenixsv\Bittrex\Requests\Request;
use codenixsv\Bittrex\Requests\BittrexRequest;

/**
 * Class PrivateBittrexRequestManager
 * @package codenixsv\Bittrex\Requests\Managers
 */
class PrivateBittrexRequestManager extends BittrexRequestManager
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $secret;

    /**
     * PrivateBittrexRequestManager constructor.
     * @param string $key
     * @param string $secret
     */
    public function __construct(string $key, string $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @param string $url
     * @return string
     */
    private function generateSign(string $url): string
    {
        $sign = hash_hmac('sha512', $url, $this->secret);

        return $sign;
    }

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return Request
     */
    public function createGetRequest(string $path, array $parameters = [], array $headers = []): Request
    {
        $url = $this->generateUrlForGetRequest($path, $parameters);
        $headers['apisign'] = $this->generateSign($url);
        $parameters['apikey'] = $this->key;

        $httpHeaders = $this->generateHttpHeaders($headers);

        return new BittrexRequest($url, $httpHeaders, $parameters);
    }

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return Request
     */
    public function createPostRequest(string $path, array $parameters = [], array $headers = []): Request
    {
        $url = $this->generateUrlForPostRequest($path);

        $headers['apisign'] = $this->generateSign($url);
        $parameters['apikey'] = $this->key;

        $httpHeaders = $this->generateHttpHeaders($headers);

        return new BittrexRequest($url, $httpHeaders, $parameters);
    }

    /**
     * @param string $path
     * @param array $parameters
     * @return string
     */
    private function generateUrlForGetRequest(string $path, array $parameters = []): string
    {
        $parameters['apikey'] = $this->key;
        $parameters['nonce'] = time();

        return $this->getBaseUrl() . $path . '?' . http_build_query($parameters);
    }

    /**
     * @param string $path
     * @return string
     */
    private function generateUrlForPostRequest(string $path): string
    {
        return $this->getBaseUrl() . $path;
    }
}
