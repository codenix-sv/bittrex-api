<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Middleware;

use Psr\Http\Message\RequestInterface;
use Closure;

class Authentication
{
    /** @var string */
    private $key;

    /** @var string */
    private $secret;

    /** @var string */
    private $nonce;

    /**
     * Authentication constructor.
     * @param string $key
     * @param string $secret
     * @param string $nonce
     */
    public function __construct(string $key, string $secret, string $nonce)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->nonce = $nonce;
    }

    /**
     * @param callable $next
     * @return Closure
     */
    public function __invoke(callable $next)
    {
        return function (RequestInterface $request, array $options = []) use ($next) {

            $request = $this->addAuthQueryParams($request);
            $sign = $this->generateSign($request->getUri()->__toString());
            $request = $request->withAddedHeader('apisign', $sign);

            return $next($request, $options);
        };
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    private function addAuthQueryParams(RequestInterface $request): RequestInterface
    {
        parse_str($request->getUri()->getQuery(), $params);
        $params['nonce'] = $this->nonce;
        $params['apikey'] = $this->key;
        $uri = $request->getUri()->withQuery(http_build_query($params));

        return $request->withUri($uri);
    }

    /**
     * @param string $uri
     * @return string
     */
    private function generateSign(string $uri): string
    {
        return hash_hmac('sha512', $uri, $this->secret);
    }
}
