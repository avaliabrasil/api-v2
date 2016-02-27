<?php

use League\Fractal;

class PlaceDetailTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this resource object into a generic array
     *
     * @var \PlaceDetail $place The place to transform
     * @return array
     */
    public function transform(\PlaceDetail $place)
    {
        return [
            'id' => (int) $place->id,
            'name' => $place->name,
            'googleId' => $place->google_id,
            'city' => 'Porto Alegre',
            'state' => 'RS',
            'category' => 'Saúde',
            'type' => 'Pronto Atendimento',
            'qualityIndex' => [
                [ 
                    [3.8],
                    [3.8],
                    [3.8],
                    [3.8],
                ]
            ],
            
            'rankingPosition' => [
                'national'  => 2,
                'regional'  => 2,
                'state'     => 2,
                'municipal' => 2,
            ],
            'rankingStatus' => [
                'national'  => 'up',
                'regional'  => 'up',
                'state'     => 'up',
                'municipal' => 'none',
            ],
            'lastWeekSurveys' => 212,
            'comments'   => [
                [
                    'uid' => 1,
                    'description' => 'teste de comentario',
                ],
                [
                    'uid' => 1,
                    'description' => 'teste de comentario',
                ],
                [
                    'uid' => 1,
                    'description' => 'teste de comentario',
                ],
            ],

            'createdAt' => $place->created_at,
            'updatedAt' => $place->updated_at //ver se ao atualizar o score a gente atualiza esse campo
        ];
    }
}
