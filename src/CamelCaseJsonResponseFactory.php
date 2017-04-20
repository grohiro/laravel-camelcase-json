<?php
namespace Grohiro\LaravelCamelCaseJson;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\ResponseFactory as BaseResponseFactory;

/**
 * Convert response JSON key to camelCase
 */
class CamelCaseJsonResponseFactory extends BaseResponseFactory
{
    public function __construct($arg1, $arg2)
    {
        parent::__construct($arg1, $arg2);
    }

    public function json($data = array(), $status = 200, array $headers = array(), $options = 0)
    {
        $json = $this->encodeJson($data);
        return parent::json($json, $status, $headers, $options);
    }

    /**
     * Encode a value to camelCase JSON
     */
    public function encodeJson($value)
    {
        if ($value instanceof Collection) {
            return $this->encodeCollection($value);
        } else if ($value instanceof Model) {
            return $this->encodeModel($value);
        } else if (is_array($value)) {
            return $this->encodeArray($value);
        } else {
            return $value;
        }
    }

    /**
     * Encode a collection
     */
    public function encodeCollection($collection)
    {
        $items = [];
        foreach ($collection as $item) {
            $items[] = $this->encodeJson($item);
        }
        return $items;
    }

    /**
     * Encode a model
     */
    public function encodeModel($model)
    {
        $array = $model->toArray();
        return $this->encodeJson($array);
    }

    /**
     * Encode an array
     */
    public function encodeArray($array)
    {
        $newArray = [];
        foreach ($array as $key => $val) {
            $newArray[\camel_case($key)] = $this->encodeJson($val);
        }
        return $newArray;
    }

}
