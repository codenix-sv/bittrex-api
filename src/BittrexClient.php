<?php

declare(strict_types=1);

namespace Codenixsv\BittrexApi;

use Codenixsv\BittrexApi\Api\Account;
use Codenixsv\BittrexApi\Api\Market;
use Codenixsv\BittrexApi\Api\PublicApi;
use Codenixsv\BittrexApi\Exception\InvalidCredentialException;
use Codenixsv\BittrexApi\Middleware\Authentication;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class BittrexClient
{
    private const BASE_URI = 'https://api.bittrex.com';

    /** @var Client */
    private $publicClient;

    /** @var Client */
    private $privateClient;

    /** @var string */
    private $key = '';

    /** @var string  */
    private $secret = '';

    /**
     * @param string $key
     * @param string $secret
     */
    public function setCredential(string $key, string $secret): void
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @return PublicApi
     */
    public function public(): PublicApi
    {
        return new PublicApi($this->getPublicClient());
    }

    /**
     * @return Market
     * @throws InvalidCredentialException
     */
    public function market(): Market
    {
        return new Market($this->getPrivateClient());
    }

    /**
     * @return Account
     * @throws InvalidCredentialException
     */
    public function account(): Account
    {
        return new Account($this->getPrivateClient());
    }

    /**
     * @return Client
     */
    private function createPublicClient(): Client
    {
        return new Client(['base_uri' => self::BASE_URI]);
    }

    /**
     * @return Client
     * @throws InvalidCredentialException
     */
    private function createPrivateClient(): Client
    {
        if (empty($this->key) || empty($this->secret)) {
            throw new InvalidCredentialException('Key and secret must be set for authenticated API');
        }
        $stack = HandlerStack::create();
        $stack->push(new Authentication($this->getKey(), $this->getSecret(), (string)time()));

        return new Client(['handler' => $stack, 'base_uri' => self::BASE_URI]);
    }

    /**
     * @return Client
     * @throws InvalidCredentialException
     */
    private function getPrivateClient(): Client
    {
        return $this->privateClient ?: $this->createPrivateClient();
    }

    /**
     * @return Client
     */
    private function getPublicClient(): Client
    {
        return $this->publicClient ?: $this->createPublicClient();
    }
}
