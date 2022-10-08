<?php

namespace App\Http\Clients;

use App\Curl\CurlException;
use App\Curl\CurlInterface;

abstract class AbstractClient
{

    protected CurlInterface $curl;
    protected string $url;

    public function __construct(CurlInterface $curl, string $url)
    {
        $this->curl = $curl;
        $this->url = $url;
    }

    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->url;
    }

    protected function buildUrl(string $resource): string
    {
        return $this->url . $resource;
    }

    /**
     * @param string $url
     * @param array $params
     *
     * @return string
     */
    protected function addQueryParams(string $url, array $params): string
    {
        $query = http_build_query($params);

        return $url . (str_contains('?', $url) ? '&' : '?') . $query;
    }

    /**
     * @param $response
     *
     * @throws CurlException
     */
    protected function hasRequestError($response): void
    {
        if ($response) {
            return;
        }

        $error = $this->curl->getError();
        $errorCode = $this->curl->getErrno();
        throw new CurlException($error, $errorCode);
    }
}
