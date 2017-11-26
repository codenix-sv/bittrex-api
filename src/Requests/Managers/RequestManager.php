<?php

namespace codenixsv\Bittrex\Requests\Managers;

use codenixsv\Bittrex\Requests\Request;

/**
 * Interface RequestManager
 * @package codenixsv\Bittrex\Requests\Managers
 */
interface RequestManager
{
    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return Request
     */
    public function createGetRequest(string $path, array $parameters = [], array $headers = []): Request;

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return Request
     */
    public function createPostRequest(string $path, array $parameters = [], array $headers = []): Request;
}
