<?php

class User extends \App\Mvc\Model
{
    public $id;
    public $firstName;
    public $lastName;
    public $username;
    public $password;

    public function getSource()
    {
        return 'user';
    }

    public function columnMap()
    {
        return [
            'id' => 'id',
            'name' => 'firstName',
            'datetime' => 'lastName',
            'status' => 'username',
            'password' => 'password',
            'updated_at' => 'updatedAt',
            'created_at' => 'createdAt',
        ];
    }

    public function whitelist()
    {
        return [
            'firstName',
            'lastName',
            'password'
        ];
    }
}