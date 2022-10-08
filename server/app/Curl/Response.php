<?php

namespace App\Curl;

use JsonException;

class Response
{

    private array $response;
    private int $status_code;

    /**
     * @param string $response
     * @param string $status_code
     *
     * @throws JsonException
     */
    public function __construct(string $response, string $status_code = '200')
    {
        $this->status_code = $status_code;
        $this->response = $this->convertToResponseArray($response);
    }

    /**
     * @throws JsonException
     */
    private function convertToResponseArray(string $response): array
    {
        $response = json_decode($response, true);
        $jsonError = json_last_error();
        if ($jsonError !== JSON_ERROR_NONE || is_null($response)) {
            throw new JsonException("Cannot convert response to JSON. Response given: $this->response");
        }

        return $response;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return $this->status_code !== 200;
    }
}
