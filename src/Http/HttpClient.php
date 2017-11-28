<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

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
