<?php

namespace codenixsv\Bittrex;

use codenixsv\Bittrex\Http\HttpClient;

/**
 * Class BittrexClient
 * @package codenixsv\Bittrex
 */
class BittrexClient extends Client
{
    const API_URL = 'https://bittrex.com/api/';
    const API_VERSION = 'v1.1';

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $secret;

    /**
     * BittrexClient constructor.
     * @param string $key
     * @param string $secret
     * @param HttpClient $httpClient
     */
    public function __construct(string $key, string $secret, HttpClient $httpClient)
    {
        parent::__construct($httpClient);
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @param string $path
     * @param array $parameters
     * @return string
     */
    private function generatePublicUrl(string $path, array $parameters = []): string
    {
        return $this->getBaseUrl() . $path . '?' . http_build_query($parameters);
    }

    /**
     * @param $path
     * @param array $parameters
     * @return mixed
     */
    private function publicCall(string $path, array $parameters = [])
    {
        $url = $this->generatePublicUrl($path, $parameters);
        return $this->httpClient->get($url);
    }

    /**
     * @param $path
     * @param array $parameters
     * @return mixed
     */
    private function credentialCall(string $path, array $parameters = [])
    {
        $url = $this->generateCredentialUrl($path, $parameters);
        $headers['apisign'] = $this->generateSign($url);
        return $this->httpClient->get($url, $headers);
    }

    /**
     * @param string $path
     * @param array $parameters
     * @return string
     */
    private function generateCredentialUrl(string $path, array $parameters = []): string
    {
        $parameters['apikey'] = $this->key;
        $parameters['nonce'] = time();

        return $this->getBaseUrl() . $path . '?' . http_build_query($parameters);
    }

    /**
     * @param string $url
     * @return string
     */
    private function generateSign(string $url): string
    {
        $sign = hash_hmac('sha512', $url, $this->secret);
        return $sign;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
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
    public function getTicker(string $market = 'BTC-LTC')
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
    public function getMarketSummary(string $market = 'BTC-LTC')
    {
        $parameters['market'] = $market;
        return $this->publicCall('/public/getmarketsummary', $parameters);
    }

    /**
     * @param string $market
     * @param string $type
     * @return mixed
     */
    public function getOrderBook(string $market = 'BTC-LTC', $type = 'both')
    {
        $parameters['market'] = $market;
        $parameters['type'] = $type;

        return $this->publicCall('/public/getorderbook', $parameters);
    }

    /**
     * @param string $market
     * @return mixed
     */
    public function getMarketHistory(string $market = 'BTC-LTC')
    {
        $parameters['market'] = $market;
        return $this->publicCall('/public/getmarkethistory', $parameters);
    }
}
