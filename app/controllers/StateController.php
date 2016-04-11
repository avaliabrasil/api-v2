<?php

use PhalconRest\Constants\ErrorCodes as ErrorCodes;
use PhalconRest\Exceptions\UserException;

/**
 * @resource("State")
 */
class StateController extends \App\Mvc\Controller
{
    public function all($name = '')
    {
        $states = State::find();

        return $this->respondCollection($states, new StateTransformer(), 'state');
    }
}