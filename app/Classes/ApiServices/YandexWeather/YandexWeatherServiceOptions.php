<?php

namespace App\Classes\ApiServices\YandexWeather;

use App\Classes\ApiServices\AbstractApiServiceOptions;
use App\Classes\ApiServices\ApiServiceException;

class YandexWeatherServiceOptions extends AbstractApiServiceOptions
{
    protected static $instance;

    public function loadOptions()
    {
        $host = env('YANDEX_WEATHER_HOST', 'https://api.weather.yandex.ru');
        $path = env('YANDEX_WEATHER_PATH', '/v1/forecast');
        $api_key = env('YANDEX_WEATHER_API_KEY', '');
        if (!$host || !$path || !$api_key) {
            throw new ApiServiceException(ApiServiceException::ERROR_MESSAGES['INVALID_OPTIONS'], ApiServiceException::ERROR_CODES['INVALID_OPTIONS']);
        }
        $this->options['path'] = $path;
        $this->options['host'] = $host;
        $this->options['api_key'] = $api_key;
    }
}
