<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Api;

use Exception;

/**
 * Class Market
 * @package Codenixsv\BittrexApi\Api
 */
class Market extends Api
{
    /**
     * @param string $market
     * @param float $quantity
     * @param float $rate
     * @return array
     * @throws Exception
     */
    public function buyLimit(string $market, float $quantity, float $rate): array
    {
        $parameters = ['market' => $market, 'quantity' => $quantity, 'rate' => $rate];

        return $this->get('/market/buylimit', $parameters);
    }

    /**
     * @param string $market
     * @param float $quantity
     * @param float $rate
     * @return array
     * @throws Exception
     */
    public function sellLimit(string $market, float $quantity, float $rate): array
    {
        $parameters = ['market' => $market, 'quantity' => $quantity, 'rate' => $rate];

        return $this->get('/market/selllimit', $parameters);
    }

    /**
     * @param string $uuid
     * @return array
     * @throws Exception
     */
    public function cancel(string $uuid): array
    {
        $parameters = ['uuid' => $uuid];

        return $this->get('/market/cancel', $parameters);
    }

    /**
     * @param string|null $market
     * @return array
     * @throws Exception
     */
    public function getOpenOrders(?string $market = null): array
    {
        $parameters = [];

        if (!is_null($market)) {
            $parameters['market'] = $market;
        }

        return $this->get('/market/getopenorders', $parameters);
    }
}
