<?php

namespace codenixsv\Bittrex;

use codenixsv\Bittrex\Http\HttpClient;

class BittrexClient extends Client
{
    const API_URL = 'https://bittrex.com/api/';
    const API_VERSION = 'v1.1';

    private $key;
    private $secret;

    /**
     * BittrexClient constructor.
     * @param $key
     * @param $secret
     * @param HttpClient $httpClient
     */
    public function __construct($key, $secret, HttpClient $httpClient)
    {
        parent::__construct($httpClient);
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @param $path
     * @param array $parameters
     * @return string
     */
    private function generatePublicUrl($path, $parameters = [])
    {
        return $this->getBaseUrl() . $path . '?' . http_build_query($parameters);
    }

    /**
     * @param $path
     * @param array $parameters
     * @return mixed
     */
    private function publicCall($path, $parameters = [])
    {
        $url = $this->generatePublicUrl($path, $parameters);
        return $this->httpClient->get($url);
    }

    /**
     * @param $path
     * @param array $parameters
     * @return mixed
     */
    private function credentialCall($path, $parameters = [])
    {
        $url = $this->generateCredentialUrl($path, $parameters);
        $headers['apisign'] = $this->generateSign($url);
        return $this->httpClient->get($url, $headers);
    }

    /**
     * @param $path
     * @param array $parameters
     * @return string
     */
    private function generateCredentialUrl($path, $parameters = [])
    {
        $parameters['apikey'] = $this->key;
        $parameters['nonce'] = time();

        return $this->getBaseUrl() . $path . '?' . http_build_query($parameters);
    }

    /**
     * @param $url
     * @return string
     */
    private function generateSign($url)
    {
        $sign = hash_hmac('sha512', $url, $this->secret);
        return $sign;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return static::API_URL . static::API_VERSION;
    }

    /**
     * @return mixed
     */
    public function getMarkets()
    {
        return $this->publicCall('/public/getmarkets');
    }

    /**
     * @return mixed
     */
    public function getCurrencies()
    {
        return $this->publicCall('/public/getcurrencies');
    }

    /**
     * @param string $market
     * @return mixed
     */
    public function getTicker($market = 'BTC-LTC')
    {
        $parameters['market'] = $market;
        return $this->publicCall('/public/getticker', $parameters);
    }

    /**
     * @return mixed
     */
    public function getMarketSummaries()
    {
        return $this->publicCall('/public/getmarketsummaries');
    }

    /**
     * @param string $market
     * @return mixed
     */
    public function getMarketSummary($market = 'BTC-LTC')
    {
        $parameters['market'] = $market;
        return $this->publicCall('/public/getmarketsummary', $parameters);
    }

    /**
     * @param string $market
     * @param string $type
     * @return mixed
     */
    public function getOrderBook($market = 'BTC-LTC', $type = 'both')
    {
        $parameters['market'] = $market;
        $parameters['type'] = $type;

        return $this->publicCall('/public/getorderbook', $parameters);
    }

    /**
     * @param string $market
     * @return mixed
     */
    public function getMarketHistory($market = 'BTC-LTC')
    {
        $parameters['market'] = $market;
        return $this->publicCall('/public/getmarkethistory', $parameters);
    }
}
