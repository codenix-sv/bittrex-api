<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Api;

use Exception;

/**
 * Class PublicApi
 * @package Codenixsv\BittrexApi\Api
 */
class PublicApi extends Api
{
    /**
     * @return array
     * @throws Exception
     */
    public function getMarkets(): array
    {
        return $this->get('/public/getmarkets');
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getCurrencies(): array
    {
        return $this->get('/public/getcurrencies');
    }

    /**
     * @param string $market
     * @return array
     * @throws Exception
     */
    public function getTicker(string $market): array
    {
        $parameters = ['market' => $market];

        return $this->get('/public/getticker', $parameters);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getMarketSummaries(): array
    {
        return $this->get('/public/getmarketsummaries');
    }

    /**
     * @param string $market
     * @return array
     * @throws Exception
     */
    public function getMarketSummary(string $market): array
    {
        $parameters = ['market' => $market];

        return $this->get('/public/getmarketsummary', $parameters);
    }

    /**
     * @param string $market
     * @param string $type
     * @return array
     * @throws Exception
     */
    public function getOrderBook(string $market, $type = 'both'): array
    {
        $parameters = ['market' => $market, 'type' => $type];

        return $this->get('/public/getorderbook', $parameters);
    }

    /**
     * @param string $market
     * @return array
     * @throws Exception
     */
    public function getMarketHistory(string $market)
    {
        $parameters = ['market' => $market];

        return $this->get('/public/getmarkethistory', $parameters);
    }
}
