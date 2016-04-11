<?php
use Phalcon\Mvc\Model\Query;


class City extends \App\Mvc\Model
{
    public $id;
    public $title;
    public $id_city;
    

    public function getSource()
    {
        return 'city';
    }

    public function columnMap()
    {
        return [
            'id'             => 'id',
            'id_state'       => 'id_state',
            'title'          => 'title',
            'iso'            => 'iso',
            'iso_ddd'        => 'iso_ddd',
            'status'         => 'status',
            'created_at'     => 'created_at',
            'updated_at'     => 'updated_at'
        ];
    }

    public function initialize() {
        // $this->hasMany("id", "Place", "id_city", array(
        //     "alias" => "CityName",
        // ));

        // $this->belongsTo(
        //     "id_state",
        //     "State",
        //     "id",
        //     array(
        //         "foreignKey" => array(
        //             "allowNulls" => false,
        //             "message"    => "The id_state does not exist on the State model"
        //         )
        //     )
        // );

    }

}
