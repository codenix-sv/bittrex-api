<?php

namespace codenixsv\Bittrex\tests\unit\Requests\Managers;

use codenixsv\Bittrex\Requests\Managers\PublicBittrexRequestManager;
use PHPUnit\Framework\TestCase;
use codenixsv\Bittrex\Requests\Request;

/**
 * Class PublicBittrexRequestManagerTest
 * @package codenixsv\Bittrex\tests\unit\Requests\Managers
 */
final class PublicBittrexRequestManagerTest extends TestCase
{
    public function testGetVersion()
    {
        $manager = new PublicBittrexRequestManager();
        $version = 'v1.1';

        $this->assertEquals($version, $manager->getVersion());
    }

    public function testGetBaseUrl()
    {
        $manager = new PublicBittrexRequestManager();
        $baseUrl = 'https://bittrex.com/api/v1.1';

        $this->assertEquals($baseUrl, $manager->getBaseUrl());
    }

    public function testCreateGetRequest()
    {
        $path = '/manage/test';
        $parameters = ['user' => 'name', 'pass' => '1234'];
        $headers = ['sign' => 'qwerty', 'login' => 'test'];

        $manager = new PublicBittrexRequestManager();
        $request = $manager->createGetRequest($path, $parameters, $headers);

        $expectedUrl = 'https://bittrex.com/api/v1.1/manage/test?user=name&pass=1234';

        $outputHeaders = $request->getHeaders();

        $this->assertInstanceOf(Request::class, $request);
        $this->assertEquals($expectedUrl, $request->getUrl());
        $this->assertEquals($parameters, $request->getParameters());

        $this->assertEquals('sign: qwerty', $outputHeaders[0]);
        $this->assertEquals('login: test', $outputHeaders[1]);
    }

    public function testCreatePostRequest()
    {
        $path = '/manage/test';
        $parameters = ['user' => 'name', 'pass' => '1234'];
        $headers = ['sign' => 'qwerty', 'login' => 'test'];


        $manager = new PublicBittrexRequestManager();
        $request = $manager->createPostRequest($path, $parameters, $headers);

        $expectedUrl = 'https://bittrex.com/api/v1.1/manage/test';

        $this->assertInstanceOf(Request::class, $request);
        $this->assertEquals($expectedUrl, $request->getUrl());
        $this->assertEquals($parameters, $request->getParameters());

        $outputHeaders = $request->getHeaders();

        $this->assertEquals('sign: qwerty', $outputHeaders[0]);
        $this->assertEquals('login: test', $outputHeaders[1]);
    }
}
