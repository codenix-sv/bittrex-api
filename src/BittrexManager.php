<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

namespace codenixsv\Bittrex;

use codenixsv\Bittrex\Clients\BittrexClient;
use codenixsv\Bittrex\Http\CurlHttpClient;
use codenixsv\Bittrex\Requests\Managers\PrivateBittrexRequestManager;
use codenixsv\Bittrex\Requests\Managers\PublicBittrexRequestManager;

/**
 * Class Client
 * @package codenixsv\Bittrex
 */
class BittrexManager
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $secret;

    /**
     * BittrexManager constructor.
     * @param string $key
     * @param string $secret
     */
    public function __construct(string $key, string $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @return BittrexClient
     */
    public function createClient(): BittrexClient
    {
        $httpClient = new CurlHttpClient();
        $publicRequestManager = new PublicBittrexRequestManager();
        $privateRequestManager = new PrivateBittrexRequestManager($this->key, $this->secret);

        return new BittrexClient($httpClient, $publicRequestManager, $privateRequestManager);
    }
}
