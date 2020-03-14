<?php

namespace App\Classes\ApiServices\YandexWeather;

use App\Classes\ApiServices\AbstractApiServiceOptions;
use App\Classes\ApiServices\AbstractApiService;
use App\Classes\ApiServices\ApiServiceResponse;

class YandexWeatherService extends AbstractApiService
{
    const METHOD_SEND = 'forecast';

    /**
     * YandexWeatherService constructor.
     */
    protected function __construct()
    {
    }

    /**
     * @return YandexWeather
     */
    public static function create()
    {
        return new YandexWeatherService();
    }

    /**
     * @return ApiServiceResponse
     */
    public function send($lat,$lon): ApiServiceResponse
    {
        $headers = array('X-Yandex-API-Key' => $this->getServiceOptions()->getFromOptions('api_key'));
        return $this->sender()->sendGet(self::METHOD_SEND, $this->getParams([
            'lat' => $lat,
            'lon' => $lon
        ]), $headers);
    }

    /**
     * @return AbstractApiServiceOptions
     */
    public function getServiceOptions(): AbstractApiServiceOptions
    {
        return YandexWeatherServiceOptions::instance();
    }
}
