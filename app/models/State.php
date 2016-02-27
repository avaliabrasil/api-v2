<?php
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Relation;


class State extends \App\Mvc\Model
{
    public $id;
    public $title;
    public $id_region;
    public $id_country;
    public $letter;


    public function getSource()
    {
        return 'state';
    }

    public function columnMap()
    {
        return [
            'id'             => 'id',
            'id_country'     => 'id_country',
            'id_region'      => 'id_region',
            'title'          => 'title',
            'letter'         => 'letter',
            'iso'            => 'iso',
            'status'         => 'status',
            'created_at'     => 'created_at',
            'updated_at'     => 'updated_at'
        ];
    }

    public function initialize() {
         $this->hasMany(
            'id',
            'City',
            'id_city',
            array(
                'foreignKey' => array(
                    'action' => Relation::ACTION_CASCADE
                )
            )
        );
    }
}
