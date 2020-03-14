<?php

namespace App\Classes\ApiServices;


abstract class AbstractApiServiceOptions
{
    protected static $instance;

    protected $options = [];

    protected function __construct()
    {
        $this->loadOptions();
    }

    abstract function loadOptions();

    /**
     * @return static
     */
    public static function instance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @return string
     */
    public function getHost() {
        return $this->getFromOptions('host');
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->getFromOptions('path');
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->getHost() . $this->getPath();
    }

    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed
     */
    public function getFromOptions($key, $default = null)
    {
        return data_get($this->options, $key, $default);
    }
}