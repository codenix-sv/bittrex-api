<?php

namespace codenixsv\Bittrex\tests\unit\Clients;

use codenixsv\Bittrex\Clients\Client;
use codenixsv\Bittrex\Requests\BittrexRequest;
use PHPUnit\Framework\TestCase;
use codenixsv\Bittrex\Http\CurlHttpClient;

/**
 * Class ClientTest
 * @package codenixsv\Bittrex\tests\unit\Clients
 */
final class ClientTest extends TestCase
{
    private $httpClient;

    public function setUp()
    {
        $httpClient = $this->createMock(CurlHttpClient::class);

        $httpClient->method('get')
            ->willReturn('foo');

        $httpClient->method('post')
            ->willReturn('foo');

        $this->httpClient = $httpClient;
    }

    public function testGet()
    {
        $request = new BittrexRequest('testurl');
        $client = new Client($this->httpClient);

        $this->assertEquals($client->get($request), 'foo');
    }

    public function testPost()
    {
        $request = new BittrexRequest('testurl');
        $client = new Client($this->httpClient);

        $this->assertEquals($client->post($request), 'foo');
    }

    public function tearDown()
    {
        unset($this->httpClient);
    }
}
