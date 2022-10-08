<?php

namespace App\Curl;

use CurlHandle;
use Illuminate\Support\Facades\Log;

class Curl implements CurlInterface
{

    private CurlHandle $curl;

    /**
     * @inheritDoc
     */
    public function initialize(string $url = ''): bool|CurlHandle
    {
        $this->curl = empty($url) ? curl_init() : curl_init($url);

        return $this->curl;
    }

    /**
     * @inheritDoc
     */
    public function setOptions(array $options = []): bool
    {
        return curl_setopt_array($this->curl, $options);
    }

    /**
     * @inheritDoc
     */
    public function setOption(int $option, $value): bool
    {
        return curl_setopt($this->curl, $option, $value);
    }

    /**
     * @inheritDoc
     */
    public function setHeader(array $header): void
    {
        $headers = [];
        foreach ($header as $key => $value) {
            $headers[] = "$key: $value";
        }

        $this->setOption(CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * @inheritDoc
     */
    public function execute(): string|bool
    {

        return curl_exec($this->curl);
    }

    /**
     * @inheritDoc
     */
    public function getInfo(int $option): mixed
    {
        return curl_getinfo($this->curl, $option);
    }

    /**
     * @inheritDoc
     */
    public function getError(): string
    {
        return curl_error($this->curl);
    }

    /**
     * @inheritDoc
     */
    public function getErrno(): int
    {
        return curl_errno($this->curl);
    }

    /**
     * @inheritDoc
     */
    public function close(): void
    {
        curl_close($this->curl);
    }
}
