<?php
use Phalcon\Mvc\Model\Query;


class Region extends \App\Mvc\Model
{
    public $id;
    public $title;
    

    public function getSource()
    {
        return 'region';
    }

    public function columnMap()
    {
        return [
            'id'             => 'id',
            'id_language'    => 'id_language',
            'title'          => 'title',
            'status'         => 'status',
            'created_at'     => 'created_at',
            'updated_at'     => 'updated_at'
        ];
    }

    public function initialize() {

    }

}
