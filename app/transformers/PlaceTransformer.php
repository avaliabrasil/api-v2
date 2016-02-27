<?php

use League\Fractal;

class PlaceTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this resource object into a generic array
     *
     * @var \Place $place The place to transform
     * @return array
     */
    public function transform(\Place $place)
    {
        //print_r($place);

        return [
            'id' => (int) $place->id,
            'name' => $place->name,
            'googleId' => $place->google_id,
            'address' => $place->address,
            'city' => $place->City->title,
            'state' => 'Sigla do Estado',
            'website' => 'site',
            'openHours' => 'open hours',
            'phone' => '(51) 3359-8000',
            'qualityIndex' => 10.2,
            'rankingPosition' => 2,
            'rankingStatus' => 'up',
            'createdAt' => $place->created_at,
            'updatedAt' => $place->updated_at
        ];
    }
}
