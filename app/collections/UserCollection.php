<?php

class UserCollection extends \Phalcon\Mvc\Micro\Collection
{
    public function __construct()
    {
        $this->setHandler('UserController', true);
        $this->setPrefix('/user');

        $this->get('/me', 'me');
        $this->post('/authenticate', 'authenticate');
    }
}
