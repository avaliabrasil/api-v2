<?php

class Place extends \App\Mvc\Model
{
    public $id;
    public $name;

    public function getSource()
    {
        return 'place';
    }

    public function columnMap()
    {
        return [
            'id'             => 'id',
            'id_type'        => 'id_type',
            'name'           => 'name',
            'google_id'      => 'google_id',
            'id_city'        => 'id_city',
            'status'         => 'status',
            'created_at'     => 'created_at',
            'updated_at'     => 'updated_at'
        ];
    }

    public function whitelist()
    {
        return [
            'name',
        ];
    }

    public function initialize() {
        $this->belongsTo('city_id', 'City', 'id', array(
            "alias" => "CityName",
        ));
    }
    public function getCityName() {
        return 'Porto Alegre';
    }
}
