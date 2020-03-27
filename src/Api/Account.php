<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi\Api;

use Exception;

/**
 * Class Account
 * @package Codenixsv\BittrexApi\Api
 */
class Account extends Api
{
    /**
     * @return array
     * @throws Exception
     */
    public function getBalances(): array
    {
        return $this->get('/account/getbalances');
    }

    /**
     * @param string $currency
     * @return array
     * @throws Exception
     */
    public function getBalance(string $currency): array
    {
        $parameters = ['currency' => $currency];

        return $this->get('/account/getbalance', $parameters);
    }

    /**
     * @param string $currency
     * @return array
     * @throws Exception
     */
    public function getDepositAddress(string $currency): array
    {
        $parameters = ['currency' => $currency];

        return $this->get('/account/getdepositaddress', $parameters);
    }

    /**
     * @param string $currency
     * @param float $quantity
     * @param string $address
     * @param string|null $paymentId
     * @return array
     * @throws Exception
     */
    public function withdraw(string $currency, float $quantity, string $address, ?string $paymentId = null): array
    {
        $parameters = ['currency' => $currency, 'quantity' => (string)$quantity, 'address' => $address];

        if (!is_null($paymentId)) {
            $parameters['paymentid'] = $paymentId;
        }

        return $this->get('/account/withdraw', $parameters);
    }

    /**
     * @param string $uuid
     * @return array
     * @throws Exception
     */
    public function getOrder(string $uuid): array
    {
        $parameters = ['uuid' => $uuid];

        return $this->get('/account/getorder', $parameters);
    }

    /**
     * @param string|null $market
     * @return array
     * @throws Exception
     */
    public function getOrderHistory(?string $market = null): array
    {
        $parameters = [];

        if (!is_null($market)) {
            $parameters['market'] = $market;
        }

        return $this->get('/account/getorderhistory', $parameters);
    }

    /**
     * @param string|null $currency
     * @return array
     * @throws Exception
     */
    public function getWithdrawalHistory(string $currency = null): array
    {
        $parameters = [];

        if (!is_null($currency)) {
            $parameters['currency'] = $currency;
        }

        return $this->get('/account/getwithdrawalhistory', $parameters);
    }

    /**
     * @param string|null $currency
     * @return array
     * @throws Exception
     */
    public function getDepositHistory(?string $currency = null): array
    {
        $parameters = [];

        if (!is_null($currency)) {
            $parameters['currency'] = $currency;
        }

        return $this->get('/account/getdeposithistory', $parameters);
    }
}
