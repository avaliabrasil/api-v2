<?php

use PhalconRest\Constants\ErrorCodes as ErrorCodes;
use PhalconRest\Exceptions\UserException;

/**
 * @resource("Place")
 */
class PlaceDetailController extends \App\Mvc\Controller
{
    /**
     * @title("Find")
     * @description("Get all products")
     * @response("Product object or Error object")
     * @requestExample("GET /product/14")
     * @responseExample({
     *     "product": {
     *         "title": "Title",
     *         "brand": "Brand name",
     *         "color": "green",
     *         "createdAt": "1427646703000",
     *         "updatedAt": "1427646703000"
     *     }
     * })
     */
    public function find($google_id)
    {
        //$place = Place::findFirst((int)$google_id);
        $place = PlaceDetail::findFirst([
            'conditions' => 'google_id = :google_id:',
            'bind' => ['google_id' => $google_id]
        ]);


        if (!$place) {
            throw new UserException(ErrorCodes::DATA_NOTFOUND, 'Place with google_id: ' . $google_id . ' could not be found.');
        }

        return $this->respondItem($place, new PlaceDetailTransformer, 'placeDetail');
    }
}