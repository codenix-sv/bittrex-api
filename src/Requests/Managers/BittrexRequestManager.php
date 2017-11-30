<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

namespace codenixsv\Bittrex\Requests\Managers;

use codenixsv\Bittrex\Requests\Request;
use codenixsv\Bittrex\Helpers\CommonHelper;

/**
 * Class BittrexRequestManager
 * @package codenixsv\Bittrex\Requests\Managers
 */
abstract class BittrexRequestManager implements RequestManager
{

    const API_URL = 'https://bittrex.com/api/';
    const API_VERSION = 'v1.1';

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return Request
     */
    abstract public function createGetRequest(string $path, array $parameters = [], array $headers = []): Request;

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return Request
     */
    abstract public function createPostRequest(string $path, array $parameters = [], array $headers = []): Request;

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return static::API_URL . static::API_VERSION;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return static::API_VERSION;
    }

    /**
     * @param array $headers
     * @return array
     */
    protected function generateHttpHeaders(array $headers): array
    {
        return CommonHelper::arrayToHttpHeaders($headers);
    }
}
