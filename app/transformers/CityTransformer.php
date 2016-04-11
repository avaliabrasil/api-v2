<?php

use League\Fractal;

class CityTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this resource object into a generic array
     *
     * @var \City $city The city to transform
     * @return array
     */
    public function transform(\City $city)
    {
        return [
            'id'        => (int) $city->id,
            'title'      => $city->title,
            'idState'   => $city->id_state
            // 'createdAt' => $city->created_at,
            // 'updatedAt' => $city->updated_at
        ];
    }
}
