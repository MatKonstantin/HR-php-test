<?php

namespace App\Classes;

use App\Classes\ApiServices\YandexWeather\YandexWeatherService;
use App\Classes\ApiServices\ApiServiceResponse;

class YandexWeather
{
    // https://yandex.ru/dev/weather/doc/dg/concepts/forecast-test-docpage/
    protected $lat;
    protected $lon;

    public function __construct()
    {
        /* параметры захардкожены под тестовое задание */
        $this->lat = '53.243325';
        $this->lon = '34.363731';
    }

    /**
     * 
     * @param Loan $loan
     * @return PayoutResult
     */
    public function getTemperature()
    {
        $weather = $this->getWeather();
        if($weather->isSuccess()){
            $res = $weather->getResult();
        }
        $temp = (is_array($res) && isset($res['fact']) && is_array($res['fact']) && isset($res['fact']['temp'])) ? $res['fact']['temp'] : null;
        
        return $temp;
        
    }
    
    public function getWeather(): ApiServiceResponse
    {
        $api_response = YandexWeatherService::create()->send($this->lat,$this->lon);

        if ($api_response->isSuccess()) {
            $result = ApiServiceResponse::createSuccess($api_response->getResult());
        } else {
            $result = ApiServiceResponse::createError($api_response->getErrorMessage(), $api_response->getErrorCode(), $api_response->getErrorData());
        }

        return $result;
    }
}
