<?php

class PlaceDetailCollection extends \Phalcon\Mvc\Micro\Collection
{
    public function __construct()
    {
        $this->setHandler('PlaceDetailController', true);
        $this->setPrefix('/placeDetail');

        $this->get('/{google_id}', 'find');
    }
}