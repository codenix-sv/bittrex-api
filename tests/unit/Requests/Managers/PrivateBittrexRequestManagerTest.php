<?php

namespace codenixsv\Bittrex\tests\unit\Requests\Managers;

use codenixsv\Bittrex\Requests\Managers\PrivateBittrexRequestManager;
use PHPUnit\Framework\TestCase;
use codenixsv\Bittrex\Requests\Request;

/**
 * Class PrivateBittrexRequestManagerTest
 * @package codenixsv\Bittrex\tests\unit\Requests\Managers
 */
final class PrivateBittrexRequestManagerTest extends TestCase
{
    public function testGetVersion()
    {
        $manager = new PrivateBittrexRequestManager('jsdj84nc84slm09u32nnc', 'kdmciou3489hieuh78ergycn7erh');
        $version = 'v1.1';

        $this->assertEquals($version, $manager->getVersion());
    }

    public function testGetBaseUrl()
    {
        $manager = new PrivateBittrexRequestManager('jsdj84nc84slm09u32nnc', 'kdmciou3489hieuh78ergycn7erh');
        $baseUrl = 'https://bittrex.com/api/v1.1';

        $this->assertEquals($baseUrl, $manager->getBaseUrl());
    }

    public function testCreateGetRequest()
    {
        $path = '/manage/test';
        $parameters = ['user' => 'name', 'pass' => '1234'];
        $headers = ['sign' => 'qwerty', 'login' => 'test'];

        $manager = new PrivateBittrexRequestManager('jsdj84nc84slm09u32nnc', 'kdmciou3489hieuh78ergycn7erh');
        $request = $manager->createGetRequest($path, $parameters, $headers);

        $expectedPartUrl = 'https://bittrex.com/api/v1.1/manage/test?user=name&pass=1234&apikey=jsdj84nc84slm09u32nnc';

        $expectedParameters = $parameters;
        $expectedParameters['apikey'] = 'jsdj84nc84slm09u32nnc';

        $outputHeaders = $request->getHeaders();

        $this->assertInstanceOf(Request::class, $request);
        $this->assertContains($expectedPartUrl, $request->getUrl());
        $this->assertEquals($expectedParameters, $request->getParameters());

        $this->assertEquals('sign: qwerty', $outputHeaders[0]);
        $this->assertEquals('login: test', $outputHeaders[1]);
        $this->assertContains('apisign:', $outputHeaders[2]);
    }

    public function testCreatePostRequest()
    {
        $path = '/manage/test';
        $parameters = ['user' => 'name', 'pass' => '1234'];
        $headers = ['sign' => 'qwerty', 'login' => 'test'];

        $manager = new PrivateBittrexRequestManager('jsdj84nc84slm09u32nnc', 'kdmciou3489hieuh78ergycn7erh');
        $request = $manager->createPostRequest($path, $parameters, $headers);

        $outputHeaders = $request->getHeaders();

        $this->assertInstanceOf(Request::class, $request);

        $this->assertEquals('sign: qwerty', $outputHeaders[0]);
        $this->assertEquals('login: test', $outputHeaders[1]);
        $this->assertContains('apisign:', $outputHeaders[2]);
    }
}
