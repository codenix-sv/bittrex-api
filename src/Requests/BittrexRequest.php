<?php

namespace codenixsv\Bittrex\Requests;

/**
 * Class BittrexRequest
 * @package codenixsv\Bittrex\Requests
 */
class BittrexRequest extends BaseRequest
{
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}
