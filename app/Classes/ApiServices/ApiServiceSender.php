<?php

namespace App\Classes\ApiServices;

use GuzzleHttp\Client;

/**
 * Класс отправки запросов на внешние API
 * Class Sender
 * @package App\Classes\Microservices
 */
class ApiServiceSender
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $request_service;

    /**
     * MicroserviceSender constructor.
     * @throws AbstractApiServiceOptions
     */
    protected function __construct(AbstractApiServiceOptions $options)
    {
        $this->request_service = new Client([
            'base_uri' => $options->getUrl()
        ]);
    }

    /**
     * @return ApiServiceSender
     */
    public static function factory(AbstractApiServiceOptions $options)
    {
        return new self($options);
    }

    /**
     * Метод отправки запроса
     *
     * @param string $method
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return ApiServiceResponse
     */
    protected function sendRequest($method, $path, $body = [], $headers = [])
    {
        try {
            $http_body = $method === self::METHOD_POST ? 'form_params' : 'query';
            $response_guzzle = $this->request_service->request($method, $path, [$http_body => $body, 'headers' => $headers])->getBody()->getContents();
        } catch (\Exception $e) {
            return new ApiServiceResponse(false, [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }

        $response_array = json_decode($response_guzzle, true, 512);
        if (!is_array($response_array)) {
            $response_array = [
                'body' => is_string($response_array) ? $response_array : $response_guzzle
            ];
        }

        return new ApiServiceResponse(true, $response_array);
    }

    /**
     * Отправка POST запроса
     *
     * @param string $path
     * @param array $query_params
     * @return ApiServiceResponse
     */
    public function sendPost($path, $query_params = [], $headers = []): ApiServiceResponse
    {
        return $this->sendRequest(self::METHOD_POST, $path, $query_params, $headers);
    }

    /**
     * Отправка GET запроса
     *
     * @param string $path
     * @param array $query_params
     * @return ApiServiceResponse
     */
    public function sendGet($path, $query_params = [], $headers = []): ApiServiceResponse
    {
        return $this->sendRequest(self::METHOD_GET, $path, $query_params, $headers);
    }
}
