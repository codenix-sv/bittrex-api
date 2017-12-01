<?php

namespace codenixsv\Bittrex\tests\functional\Http;

use PHPUnit\Framework\TestCase;
use codenixsv\Bittrex\Http\CurlHttpClient;
use codenixsv\Bittrex\Exceptions\CurlException;

/**
 * Class CurlHttpClientTest
 * @package codenixsv\Bittrex\tests\functional\Http
 */
final class CurlHttpClientTest extends TestCase
{
    /**
     * @throws \codenixsv\Bittrex\Exceptions\CurlException
     */
    public function testGet()
    {
        $value = 'testvalue';
        $client = new CurlHttpClient();

        $response = $client->get('https://httpbin.org/get?test=' . $value);

        $resultArray = json_decode($response, true);
        $this->assertArrayHasKey('args', $resultArray);
        $this->assertEquals($value, $resultArray['args']['test']);
    }

    /**
     * @throws \codenixsv\Bittrex\Exceptions\CurlException
     */
    public function testPost()
    {
        $value = 'testvalue';
        $client = new CurlHttpClient();

        $response = $client->post('https://httpbin.org/post', ['test' => $value]);

        $resultArray = json_decode($response, true);
        $this->assertArrayHasKey('form', $resultArray);
        $this->assertEquals($value, $resultArray['form']['test']);
    }

    /**
     * @throws \codenixsv\Bittrex\Exceptions\CurlException
     */
    public function testPostWithHeaders()
    {
        $value = 'testvalue';
        $client = new CurlHttpClient();

        $headerValue = 'test-header-value';
        $headers = ['Test-Header: ' . $headerValue];

        $response = $client->post('https://httpbin.org/post', ['test' => $value], $headers);

        $resultArray = json_decode($response, true);
        $this->assertArrayHasKey('form', $resultArray);
        $this->assertEquals($value, $resultArray['form']['test']);

        $this->assertArrayHasKey('headers', $resultArray);
        $this->assertEquals($headerValue, $resultArray['headers']['Test-Header']);
    }

    /**
     * @throws \codenixsv\Bittrex\Exceptions\CurlException
     */
    public function testGetWithHeaders()
    {
        $value = 'testvalue';
        $client = new CurlHttpClient();

        $headerValue = 'test-header-value';
        $headers = ['Test-Header: ' . $headerValue];

        $response = $client->get('https://httpbin.org/get?test=' . $value, $headers);

        $resultArray = json_decode($response, true);
        $this->assertArrayHasKey('args', $resultArray);
        $this->assertEquals($value, $resultArray['args']['test']);

        $this->assertArrayHasKey('headers', $resultArray);
        $this->assertEquals($headerValue, $resultArray['headers']['Test-Header']);
    }

    /**
     * @throws \codenixsv\Bittrex\Exceptions\CurlException
     */
    public function testException()
    {
        $this->expectException(CurlException::class);

        $client = new CurlHttpClient();

        $client->get('-https://httpbin.org/get');
    }
}