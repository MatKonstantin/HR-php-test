<?php

namespace App\Classes\ApiServices;


abstract class AbstractApiService
{

    /**
     * @return AbstractApiServiceOptions
     */
    public function sender(): ApiServiceSender
    {
        return ApiServiceSender::factory($this->getServiceOptions());
    }

    /**
     * @return AbstractApiAerviceOptions
     */
    abstract function getServiceOptions(): AbstractApiServiceOptions;

    /**
     * Получение параметров для запроса
     * @param array $params
     * @return array
     */
    protected function getParams($params = [])
    {
        return array_merge($params, $this->getBaseParams());
    }

    /**
     * Получение обязательных параметров для запроса
     * @return array
     */
    protected function getBaseParams()
    {
        return [];
    }
}
