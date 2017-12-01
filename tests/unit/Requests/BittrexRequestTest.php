<?php

namespace codenixsv\Bittrex\tests\unit\Requests;

use PHPUnit\Framework\TestCase;
use codenixsv\Bittrex\Requests\BittrexRequest;

/**
 * Class BittrexRequestTest
 * @package codenixsv\Bittrex\tests\unit\Requests
 */
final class BittrexRequestTest extends TestCase
{
    public function testGetUrl()
    {
        $url = 'https://test.com/api/test';

        $request = new BittrexRequest($url);

        $this->assertEquals($url, $request->getUrl());
    }

    public function testGetHeaders()
    {
        $url = 'https://test.com/api/test';

        $headers = [
            'user' => 'name',
            'sign' => 'secret',

        ];

        $request = new BittrexRequest($url, $headers);

        $this->assertEquals($headers, $request->getHeaders());
    }

    public function testGetParameters()
    {
        $url = 'https://test.com/api/test';

        $headers = [
            'user' => 'name',
            'sign' => 'secret',

        ];

        $parameters = [
            'date' => '2017-10-10',
            'time' => '15:00:00',

        ];

        $request = new BittrexRequest($url, $headers, $parameters);

        $this->assertEquals($parameters, $request->getParameters());
    }
}
