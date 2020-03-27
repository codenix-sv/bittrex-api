<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Tests\Api;

use Codenixsv\BittrexApi\Api\Market;

class MarketTest extends ApiTestCase
{
    public function testBuyLimit()
    {
        $this->createApi()->buyLimit('USDT-BTC', 1, 1);
        $request = $this->getLastRequest();

        $this->assertEquals(
            '/api/v1.1/market/buylimit?market=USDT-BTC&quantity=1&rate=1&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testSellLimit()
    {
        $this->createApi()->sellLimit('BTC-LTC', 1.2, 1.3);
        $request = $this->getLastRequest();

        $this->assertEquals(
            '/api/v1.1/market/selllimit?market=BTC-LTC&quantity=1.2&rate=1.3&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testCancel()
    {
        $this->createApi()->cancel('251c48e7-95d4-d53f-ad76-a7c6547b74ca9');
        $request = $this->getLastRequest();

        $this->assertEquals(
            '/api/v1.1/market/cancel?uuid=251c48e7-95d4-d53f-ad76-a7c6547b74ca9&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testGetOpenOrders()
    {
        $this->createApi()->getOpenOrders();

        $request = $this->getLastRequest();
        $this->assertEquals(
            '/api/v1.1/market/getopenorders?nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testGetOpenOrdersWithMarket()
    {
        $this->createApi()->getOpenOrders('BTC-LTC');

        $request = $this->getLastRequest();
        $this->assertEquals(
            '/api/v1.1/market/getopenorders?market=BTC-LTC&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    private function createApi(): Market
    {
        return new Market($this->getMockClient(true));
    }
}
