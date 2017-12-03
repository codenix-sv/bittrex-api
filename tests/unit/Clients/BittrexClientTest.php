<?php

namespace codenixsv\Bittrex\tests\unit\Clients;

use PHPUnit\Framework\TestCase;
use codenixsv\Bittrex\Http\CurlHttpClient;
use codenixsv\Bittrex\Requests\Managers\PublicBittrexRequestManager;
use codenixsv\Bittrex\Requests\Managers\PrivateBittrexRequestManager;
use codenixsv\Bittrex\Clients\BittrexClient;

/**
 * Class BittrexClientTest
 * @package codenixsv\Bittrex\tests\unit\Clients
 */
final class BittrexClientTest extends TestCase
{
    /**
     * @var BittrexClient
     */
    private $bittrexClient;

    public function setUp()
    {
        $httpClient = $this->createMock(CurlHttpClient::class);

        $httpClient->method('get')
            ->willReturn('success GET');

        $httpClient->method('post')
            ->willReturn('success POST');

        $publicRequestManager = new PublicBittrexRequestManager();
        $privateRequestManager = new PrivateBittrexRequestManager('ldk834jimkonfv6', 'foiucksdf9034jdvc87');

        $this->bittrexClient = new BittrexClient($httpClient, $publicRequestManager, $privateRequestManager);
    }


    public function testGetMarkets()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getMarkets());
    }

    public function testGetCurrencies()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getCurrencies());
    }

    public function testGetTickers()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getTicker('BTC-LTC'));
    }

    public function testMarketSummaries()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getMarketSummaries());
    }

    public function testGetMarketSummary()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getMarketSummary('BTC-LTC'));
    }

    public function testGetOrderBook()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getOrderBook('BTC-LTC'));
    }

    public function testGetMarketHistory()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getMarketHistory('BTC-LTC'));
    }

    public function testBuyLimit()
    {
        $this->assertEquals('success GET', $this->bittrexClient->buyLimit('BTC-LTC', 1.2, 1.3));
    }

    public function testSellLimit()
    {
        $this->assertEquals('success GET', $this->bittrexClient->sellLimit('BTC-LTC', 1.2, 1.3));
    }

    public function testCancel()
    {
        $this->assertEquals('success GET', $this->bittrexClient->cancel('251c48e7-95d4-d53f-ad76-a7c6547b74ca9'));
    }

    public function testGetOpenOrders()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getOpenOrders('BTC-LTC'));
    }

    public function testGetBalances()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getBalances());
    }

    public function testGetBalance()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getBalance('BTC'));
    }

    public function testGetDepositAddress()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getDepositAddress('BTC'));
    }

    public function testWithdraw()
    {
        $this->assertEquals(
            'success GET',
            $this->bittrexClient->withdraw('BTC', 20.40, 'EAC_ADDRESS  ', '')
        );
    }

    public function testGetOrder()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getOrder('251c48e7-95d4-d53f-ad76-a7c6547b74ca9'));
    }

    public function testGetOrderHistory()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getOrderHistory('BTC-LTC'));
    }

    public function testGetWithdrawalHistory()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getWithdrawalHistory('BTC'));
    }

    public function testGetDepositHistory()
    {
        $this->assertEquals('success GET', $this->bittrexClient->getDepositHistory('BTC'));
    }

    public function tearDown()
    {
        unset($this->bittrexClient);
    }
}
