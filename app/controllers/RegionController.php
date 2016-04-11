<?php

use PhalconRest\Constants\ErrorCodes as ErrorCodes;
use PhalconRest\Exceptions\UserException;

/**
 * @resource("State")
 */
class RegionController extends \App\Mvc\Controller
{
    public function all($name = '')
    {
        $regions = Region::find();

        return $this->respondCollection($regions, new RegionTransformer(), 'region');
    }
}