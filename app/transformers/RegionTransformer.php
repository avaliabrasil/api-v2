<?php

use League\Fractal;

class RegionTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this resource object into a generic array
     *
     * @var \Region $region The region to transform
     * @return array
     */
    public function transform(\Region $item)
    {
        return [
            'id'        => (int) $item->id,
            'title'     => $item->title
        ];
    }
}
