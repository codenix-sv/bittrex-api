<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Tests\Middleware;

use Codenixsv\BittrexApi\Middleware\Authentication;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class AuthenticationTest extends TestCase
{
    private const API_KEY = 'API_KEY';
    private const API_SECRET = 'API_SECRET';
    private const NONCE = '1585301777';
    private const URI = 'https://api.bittrex.com/api/v1.1/account/getbalances';
    private const METHOD = 'GET';

    public function testUri()
    {
        $request = $this->getHandledRequest(new Request(self::METHOD, self::URI, []));
        $this->assertEquals(
            self::URI . '?nonce=' . self::NONCE . '&apikey=' . self::API_KEY,
            $request->getUri()->__toString()
        );
    }

    public function testHeader()
    {
        $request = $this->getHandledRequest(new Request(self::METHOD, self::URI, []));
        $this->assertEquals(
            '041fde5a91c95dc6606b216c48d7c19dd129d8f8b4b55b286b71c82fe4772b268f39b3788c60179180c4f73d00ae7380'
            . '47c62f62ed58553b436dab533a18f273',
            $request->getHeaderLine('apisign')
        );
    }

    private function getHandledRequest(RequestInterface $request): RequestInterface
    {
        $middleware = new Authentication(self::API_KEY, self::API_SECRET, self::NONCE);
        return $middleware(function (RequestInterface $request) {
            return $request;
        })($request);
    }
}
