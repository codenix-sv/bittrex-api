<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

namespace codenixsv\Bittrex\Helpers;

/**
 * Class CommonHelper
 * @package codenixsv\Bittrex\Http
 */
class CommonHelper
{
    /**
     * @param array $headers
     * @return array
     */
    public static function arrayToHttpHeaders(array $headers)
    {
        $httpHeaders = [];
        if (self::isAssociative($headers)) {
            throw new \InvalidArgumentException('Array must be associative');
        }

        foreach ($headers as $name => $value) {
            $httpHeaders[] =  $name . ': ' . $value;
        }

        return $httpHeaders;
    }

    /**
     * @param $array
     * @return bool
     */
    public static function isAssociative($array)
    {
        $array = array_keys($array);
        return ($array !== array_keys($array));
    }
}
