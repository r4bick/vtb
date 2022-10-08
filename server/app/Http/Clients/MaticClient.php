<?php

namespace App\Http\Clients;

use App\Curl\CurlException;
use App\Curl\CurlInterface;
use App\Curl\Response;
use JsonException;

class MaticClient extends AbstractClient
{
    public const CREATE_WALLET = '/v1/wallets/new';

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
