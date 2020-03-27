<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Tests\Api;

use Codenixsv\BittrexApi\Api\PublicApi;

class PublicApiTest extends ApiTestCase
{
    public function testGetMarkets()
    {
        $this->createApi()->getMarkets();
        $request = $this->getLastRequest();

        $this->assertEquals('/api/v1.1/public/getmarkets', $request->getUri()->__toString());
    }

    public function testGetCurrencies()
    {
        $this->createApi()->getCurrencies();
        $request = $this->getLastRequest();

        $this->assertEquals('/api/v1.1/public/getcurrencies', $request->getUri()->__toString());
    }

    public function testGetTicker()
    {
        $this->createApi()->getTicker('BTC-LTC');
        $request = $this->getLastRequest();
        $this->assertEquals('/api/v1.1/public/getticker?market=BTC-LTC', $request->getUri()->__toString());
    }

    public function testGetMarketSummaries()
    {
        $this->createApi()->getMarketSummaries();

        $request = $this->getLastRequest();
        $this->assertEquals('/api/v1.1/public/getmarketsummaries', $request->getUri()->__toString());
    }

    public function testGetMarketSummary()
    {
        $this->createApi()->getMarketSummary('BTC-LTC');

        $request = $this->getLastRequest();
        $this->assertEquals('/api/v1.1/public/getmarketsummary?market=BTC-LTC', $request->getUri()->__toString());
    }

    public function testGetOrderBook()
    {
        $this->createApi()->getOrderBook('BTC-LTC');

        $request = $this->getLastRequest();
        $this->assertEquals('/api/v1.1/public/getorderbook?market=BTC-LTC&type=both', $request->getUri()->__toString());
    }

    public function testGetMarketHistory()
    {
        $this->createApi()->getMarketHistory('BTC-LTC');

        $request = $this->getLastRequest();
        $this->assertEquals('/api/v1.1/public/getmarkethistory?market=BTC-LTC', $request->getUri()->__toString());
    }

    private function createApi(): PublicApi
    {
        return new PublicApi($this->getMockClient());
    }
}
