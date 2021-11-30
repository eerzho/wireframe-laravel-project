<?php

namespace App\Components\Request;

use Illuminate\Support\Arr;
use stdClass;
use Symfony\Component\HttpFoundation\ParameterBag;

class DataTransfer
{
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = new ParameterBag($data);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data->all();
    }

    /**
     * @param null $key
     * @param null $default
     *
     * @return array|mixed|string|null
     */
    public function get($key = null, $default = null)
    {
        if ($key) {
            return $this->data->get($key, $default);
        }

        return $this->data->all();
    }

    /**
     * @param null $key
     * @param null $default
     *
     * @return array|mixed|string|null
     */
    public function post($key = null, $default = null)
    {
        return $this->get($key, $default);
    }

    /**
     * @param $keys
     *
     * @return array
     */
    public function only($keys)
    {
        $results = [];

        $input = $this->data->all();

        $placeholder = new stdClass();

        foreach (is_array($keys) ? $keys : func_get_args() as $key) {
            $value = data_get($input, $key, $placeholder);

            if ($value !== $placeholder) {
                Arr::set($results, $key, $value);
            }
        }

        return $results;
    }

    /**
     * @param $keys
     *
     * @return array
     */
    public function except($keys)
    {
        return Arr::except($this->data->all(), $keys);
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function has($key)
    {
        $keys = is_array($key) ? $key : func_get_args();

        $input = $this->data->all();

        foreach ($keys as $value) {
            if (! Arr::has($input, $value)) {
                return false;
            }
        }

        return true;
    }
}
