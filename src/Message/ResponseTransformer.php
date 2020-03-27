<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Message;

use Codenixsv\BittrexApi\Exception\TransformResponseException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseTransformer
 * @package Codenixsv\BittrexApi\Message
 */
class ResponseTransformer
{
    /**
     * @param ResponseInterface $response
     * @return array
     * @throws TransformResponseException
     */
    public function transform(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $content = json_decode($body, true);
            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }

            throw new TransformResponseException('Error transforming response to array. JSON_ERROR: '
                . json_last_error());
        }

        throw new TransformResponseException('Error transforming response to array. Content-Type 
            is not application/json');
    }
}
