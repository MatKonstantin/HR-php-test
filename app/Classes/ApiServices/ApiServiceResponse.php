<?php

namespace App\Classes\ApiServices;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Класс обработки и формирования ответов
 * Class ApiServiceResponse
 */
class ApiServiceResponse implements \JsonSerializable, Arrayable
{
    protected $success;

    protected $result = [];

    protected $error = [
        'message' => '',
        'code' => 0,
        'data' => []
    ];

    /**
     * ApiServiceResponse constructor.
     * @param bool $status
     * @param array $data
     */
    public function __construct($status, $data)
    {
        $this->success = $status;
        if ($status) {
            $this->result = $data;
        } else {
            $this->error = $data;
        }
    }

    /**
     * @param string $message
     * @param int $code
     * @param array $data
     * @return static
     */
    public static function createError($message = '', $code = 0, $data = [])
    {
        return new static(false, compact('message', 'code', 'data'));
    }

    /**
     * @param array $data
     * @return static
     */
    public static function createSuccess($data = [])
    {
        return new static(true, $data);
    }

    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed|null
     */
    public function getFromResult($key, $default = null)
    {
        return isset($this->result[$key]) ? $this->result[$key] : $default;
    }

    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed|null
     */
    public function getFromError($key, $default = null)
    {
        return isset($this->error[$key]) ? $this->error[$key] : $default;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return mixed|null
     */
    public function getErrorMessage()
    {
        return $this->getFromError('message');
    }

    /**
     * @return mixed|null
     */
    public function getErrorData()
    {
        return $this->getFromError('data');
    }

    /**
     * @return mixed|null
     */
    public function getErrorCode()
    {
        return $this->getFromError('code');
    }

    /**
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'success' => $this->success,
            'result' => $this->result,
            'error' => $this->error
        ];
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->jsonSerialize();
    }
}
