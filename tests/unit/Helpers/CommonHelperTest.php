<?php

namespace codenixsv\Bittrex\tests\unit\Helpers;

use codenixsv\Bittrex\Helpers\CommonHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class CommonHelperTest
 * @package codenixsv\Bittrex\tests\unit\Helpers
 */
final class CommonHelperTest extends TestCase
{
    public function testIsArrayAssociative()
    {
        $input = ['a' => 'foo', 'b' => 'bar', 'c' => 'ced'];

        $this->assertTrue(CommonHelper::isArrayAssociative($input));
    }

    public function testIsArrayAssociativeWrong()
    {
        $input = [0, 2, 5, 8];

        $this->assertFalse(CommonHelper::isArrayAssociative($input));
    }

    public function testArrayToHttpHeaders()
    {
        $input = ['a' => 'foo', 'b' => 'bar', 'c' => 'ced'];

        $output = CommonHelper::arrayToHttpHeaders($input);

        $expected = ['a: foo', 'b: bar', 'c: ced'];

        $this->assertEquals($expected, $output);
    }

    public function testArrayToHttpHeadersException()
    {
        $input = [0, 2, 5, 8];

        $this->expectException(\InvalidArgumentException::class);

        CommonHelper::arrayToHttpHeaders($input);
    }
}
