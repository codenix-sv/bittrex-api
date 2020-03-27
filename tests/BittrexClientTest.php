<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Tests;

use Codenixsv\BittrexApi\Api\Account;
use Codenixsv\BittrexApi\Api\Market;
use Codenixsv\BittrexApi\Api\PublicApi;
use Codenixsv\BittrexApi\BittrexClient;
use Codenixsv\BittrexApi\Exception\InvalidCredentialException;
use PHPUnit\Framework\TestCase;

class BittrexClientTest extends TestCase
{
    public function testIsEmptyInitialCredential()
    {
        $client = new BittrexClient();

        $this->assertEmpty($client->getKey());
        $this->assertEmpty($client->getSecret());
    }

    public function testSetCredential()
    {
        $secret = 'API_SECRET';
        $key = 'API_KEY';

        $client = new BittrexClient();
        $client->setCredential($key, $secret);

        $this->assertEquals($client->getKey(), $key);
        $this->assertEquals($client->getSecret(), $secret);
    }

    public function testPublic()
    {
        $client = new BittrexClient();

        $this->assertInstanceOf(PublicApi::class, $client->public());
    }

    public function testMarket()
    {
        $client = new BittrexClient();
        $client->setCredential('API_KEY', 'API_SECRET');

        $this->assertInstanceOf(Market::class, $client->market());
    }

    public function testMarketThrowInvalidCredentialException()
    {
        $client = new BittrexClient();

        $this->expectException(InvalidCredentialException::class);

        $client->market();
    }

    public function testAccount()
    {
        $client = new BittrexClient();
        $client->setCredential('API_KEY', 'API_SECRET');

        $this->assertInstanceOf(Account::class, $client->account());
    }

    public function testAccountThrowInvalidCredentialException()
    {
        $client = new BittrexClient();

        $this->expectException(InvalidCredentialException::class);

        $client->account();
    }
}
