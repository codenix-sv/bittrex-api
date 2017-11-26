<?php

namespace codenixsv\Bittrex\tests;

use PHPUnit\Framework\TestCase;
use codenixsv\Bittrex\BittrexManager;
use codenixsv\Bittrex\Clients\BittrexClient;

final class BittrexManagerTest extends TestCase
{
    public function testCreateClient()
    {
        $manager = new BittrexManager('jsdj84nc84slm09u32nnc', 'kdmciou3489hieuh78ergycn7erh');
        $client = $manager->createClient();
        $this->assertInstanceOf(BittrexClient::class, $client);
    }
}
