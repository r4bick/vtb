<?php

namespace App\Curl;

interface CurlInterface
{

    /**
     * Init curl with URL
     *
     * @param string $url URL
     *
     * @return mixed
     */
    public function initialize(string $url = ''): mixed;

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function setOptions(array $options): mixed;

    /**
     * @param int $option
     * @param mixed $value
     *
     * @return mixed
     */
    public function setOption(int $option, mixed $value): mixed;

    /**
     * @param array $header
     *
     * @return void
     */
    public function setHeader(array $header): void;

    /**
     * @return mixed
     */
    public function execute(): mixed;

    /**
     * @param int $option
     *
     * @return mixed
     */
    public function getInfo(int $option): mixed;

    /**
     * @return mixed
     */
    public function getError(): mixed;

    /**
     * @return mixed
     */
    public function getErrno(): mixed;

    /**
     * @return void
     */
    public function close(): void;
}
