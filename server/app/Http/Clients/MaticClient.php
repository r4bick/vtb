<?php

namespace App\Http\Clients;

use App\Curl\CurlException;
use App\Curl\CurlInterface;
use App\Curl\Response;
use JsonException;

class MaticClient extends AbstractClient
{
    public const CREATE_WALLET = '/v1/wallets/new';
    public const TRANSFER_DIGITAL_RUBLE = '/v1/transfers/ruble';
    public const TRANSFER_MATIC = '/v1/transfers/matic';

    public function __construct(CurlInterface $curl, string $url)
    {
        parent::__construct($curl, $url);

        $this->curl->initialize();
    }

    /**
     * @return Response
     * @throws CurlException
     * @throws JsonException
     */
    public function createWallet(): Response
    {
        $this->curl->setOption(CURLOPT_URL, $this->buildUrl(self::CREATE_WALLET));
        $this->curl->setOption(CURLOPT_POST, 1);
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, 1);

        return $this->execute();
    }

    /**
     * @param string $from_private_key
     * @param string $to_public_key
     * @param float $amount
     *
     * @return Response
     * @throws CurlException
     * @throws JsonException
     */
    public function transferDigitalRubles(string $from_private_key, string $to_public_key, float $amount): Response
    {
        $url = $this->buildUrl(self::TRANSFER_DIGITAL_RUBLE);

        return $this->transfer($url, $from_private_key, $to_public_key, $amount);
    }

    /**
     * @param string $from_private_key
     * @param string $to_public_key
     * @param float $amount
     *
     * @return Response
     * @throws CurlException
     * @throws JsonException
     */
    public function transferMatic(string $from_private_key, string $to_public_key, float $amount): Response
    {
        $url = $this->buildUrl(self::TRANSFER_MATIC);

        return $this->transfer($url, $from_private_key, $to_public_key, $amount);
    }

    /**
     * @param string $url
     * @param string $from_private_key
     * @param string $to_public_key
     * @param float $amount
     *
     * @return Response
     * @throws CurlException
     * @throws JsonException
     */
    public function transfer(string $url, string $from_private_key, string $to_public_key, float $amount): Response
    {
        $payload = json_encode([
            'fromPrivateKey' => $from_private_key,
            'toPublicKey' => $to_public_key,
            'amount' => $amount,
        ]);

        $this->curl->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer <Bearer Token>'
        ]);

        $this->curl->setOption(CURLOPT_URL, $url);
        $this->curl->setOption(CURLINFO_HEADER_OUT, 1);
        $this->curl->setOption(CURLOPT_POST, 1);
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, 1);

        $this->curl->setOption(CURLOPT_POSTFIELDS, $payload);

        return $this->execute();
    }

    /**
     * @return Response
     * @throws CurlException
     * @throws JsonException
     */
    protected function execute(): Response
    {
        $response = $this->curl->execute();
        $this->hasRequestError($response);

        $status_code = $this->curl->getInfo(CURLINFO_RESPONSE_CODE);
        $this->curl->close();

        return new Response($response, $status_code);
    }
}
