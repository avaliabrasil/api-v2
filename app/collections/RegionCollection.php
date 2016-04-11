<?php

class RegionCollection extends \Phalcon\Mvc\Micro\Collection
{
    public function __construct()
    {
        $this->setHandler('RegionController', true);
        $this->setPrefix('/regions');

        $this->get('/', 'all');
    }
}
