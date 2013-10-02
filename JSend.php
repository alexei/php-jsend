<?php

class JSend
{
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';
    const STATUS_ERROR = 'error';

    public $status = null;
    public $data = null;
    public $message = null;
    public $code = null;

    public function __construct($status = null)
    {
        if (!is_null($status)) {
            $this->status = $status;
        }
    }

    public static function success($data = null)
    {
        $response = new self(self::STATUS_SUCCESS);
        $response->data = $data;
        return $response;
    }

    public static function fail($data = null)
    {
        $response = new self(self::STATUS_FAIL);
        $response->data = $data;
        return $response;
    }

    public static function error($message = null, $code = null)
    {
        $response = new self(self::STATUS_ERROR);
        $response->message = $message;
        $response->code = $code;
        return $response;
    }

    public function __get($key)
    {
        return $this->data->{$key};
    }

    public function __set($key, $val)
    {
        if (!is_object($this->data)) {
            $this->data = new StdClass();
        }
        $this->data->{$key} = $val;
    }

    public function __isset($key)
    {
        return property_exists($this->data, $key);
    }

    public function __unset($key)
    {
        unset($this->data->{$key});
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
