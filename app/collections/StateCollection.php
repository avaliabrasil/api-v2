<?php

class StateCollection extends \Phalcon\Mvc\Micro\Collection
{
    public function __construct()
    {
        $this->setHandler('StateController', true);
        $this->setPrefix('/states');

        $this->get('/', 'all');
    }
}
