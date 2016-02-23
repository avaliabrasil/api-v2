<?php

class PlaceCollection extends \Phalcon\Mvc\Micro\Collection
{
    public function __construct()
    {
        $this->setHandler('PlaceController', true);
        $this->setPrefix('/places');

        $this->get('/', 'all');
        $this->post('/', 'create');
        $this->post('/{product_id}', 'update');
        $this->get('/{product_id}', 'find');
        $this->delete('/{product_id}', 'delete');
    }
}