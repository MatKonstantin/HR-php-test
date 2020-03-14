<?php

namespace App\Classes\ApiServices;

/*
 * Обработка ошибок запросов
 */
class ApiServiceException extends \Exception
{

    const ERROR_MESSAGES = [
        'INVALID_SERVICE_RESPONSE' => 'Invalid service response',
        'INVALID_OPTIONS' => 'Service did not configured'
    ];

    const ERROR_CODES = [
        'INVALID_SERVICE_RESPONSE' => 500,
        'INVALID_OPTIONS' => 500
    ];

}
