<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

namespace codenixsv\Bittrex\Requests;

/**
 * Interface Request
 * @package codenixsv\Bittrex\Requests
 */
interface Request
{
    /**
     * Request constructor.
     * @param string $url
     * @param array $headers
     * @param array $parameters
     */
    public function __construct(string $url, array $headers = [], array $parameters = []);

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @return array
     */
    public function getParameters(): array;
}
