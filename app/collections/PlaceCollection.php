<?php

class PlaceCollection extends \Phalcon\Mvc\Micro\Collection
{
    public function __construct()
    {
        $this->setHandler('PlaceController', true);
        $this->setPrefix('/places');

        $this->get('/', 'all');
        $this->post('/', 'create');
        $this->post('/{google_id}', 'update');
        $this->get('/{google_id}', 'find');

		$this->get('/test', 'test');

    }
}