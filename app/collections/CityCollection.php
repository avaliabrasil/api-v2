<?php

class CityCollection extends \Phalcon\Mvc\Micro\Collection
{
    public function __construct()
    {
        $this->setHandler('CityController', true);
        $this->setPrefix('/cities');

        $this->get('/', 'all');
    }
}
