<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Tests\Api;

use Codenixsv\BittrexApi\Api\Account;

class AccountTest extends ApiTestCase
{
    public function testGetBalances()
    {
        $this->createApi()->getBalances();
        $request = $this->getLastRequest();

        $this->assertEquals(
            '/api/v1.1/account/getbalances?nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testGetBalance()
    {
        $this->createApi()->getBalance('BTC');
        $request = $this->getLastRequest();

        $this->assertEquals(
            '/api/v1.1/account/getbalance?currency=BTC&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testGetDepositAddress()
    {
        $this->createApi()->getDepositAddress('BTC');
        $request = $this->getLastRequest();

        $this->assertEquals(
            '/api/v1.1/account/getdepositaddress?currency=BTC&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testWithdraw()
    {
        $this->createApi()->withdraw('BTC', 1.40, '12rwaw7p4eTQ3DL5gu4fSYYx3M3kZxxQVn', 'paymentId');

        $request = $this->getLastRequest();
        $this->assertEquals(
            '/api/v1.1/account/withdraw?currency=BTC&quantity=1.4&address=12rwaw7p4eTQ3DL5gu4fSYYx3M3kZxxQVn'
            . '&paymentid=paymentId&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testGetOrder()
    {
        $this->createApi()->getOrder('251c48e7-95d4-d53f-ad76-a7c6547b74ca9');

        $request = $this->getLastRequest();
        $this->assertEquals(
            '/api/v1.1/account/getorder?uuid=251c48e7-95d4-d53f-ad76-a7c6547b74ca9&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testGetOrderHistory()
    {
        $this->createApi()->getOrderHistory('BTC-LTC');

        $request = $this->getLastRequest();
        $this->assertEquals(
            '/api/v1.1/account/getorderhistory?market=BTC-LTC&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testGetWithdrawalHistory()
    {
        $this->createApi()->getWithdrawalHistory('BTC');

        $request = $this->getLastRequest();
        $this->assertEquals(
            '/api/v1.1/account/getwithdrawalhistory?currency=BTC&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    public function testGetDepositHistory()
    {
        $this->createApi()->getDepositHistory('BTC');

        $request = $this->getLastRequest();
        $this->assertEquals(
            '/api/v1.1/account/getdeposithistory?currency=BTC&nonce=1585301777&apikey=API_KEY',
            $request->getUri()->__toString()
        );
        $this->assertNotEmpty($request->getHeaderLine('apisign'));
    }

    private function createApi(): Account
    {
        return new Account($this->getMockClient(true));
    }
}
