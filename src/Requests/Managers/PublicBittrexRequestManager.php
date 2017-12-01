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
 * Class PublicBittrexRequestManager
 * @package codenixsv\Bittrex\Requests\Managers
 */
class PublicBittrexRequestManager extends BittrexRequestManager
{
    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return Request
     */
    public function createGetRequest(string $path, array $parameters = [], array $headers = []): Request
    {
        $url = $this->generateUrlForGetRequest($path, $parameters);

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
