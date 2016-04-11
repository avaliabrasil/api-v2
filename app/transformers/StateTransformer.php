<?php

use League\Fractal;

class StateTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this resource object into a generic array
     *
     * @var \State $state The state to transform
     * @return array
     */
    public function transform(\State $item)
    {
        return [
            'id'        => (int) $item->id,
            'title'     => $item->title,
            'idRegion'  => $item->id_region,
            'letter'    => $item->letter
        ];
    }
}
