<?php

use PhalconRest\Constants\ErrorCodes as ErrorCodes;
use PhalconRest\Exceptions\UserException;

/**
 * @resource("City")
 */
class CityController extends \App\Mvc\Controller
{
    public function all($name = '')
    {
        $cities = City::find();

        return $this->respondCollection($cities, new CityTransformer(), 'city');
    }
}