<?php

use PhalconRest\Constants\ErrorCodes as ErrorCodes;
use PhalconRest\Exceptions\UserException;

/**
 * @resource("Place")
 */
class PlaceController extends \App\Mvc\Controller
{
    /**
     * @title("All")
     * @description("Get all Places")
     * @response("Collection of Place objects or Error object")
     * @requestExample("GET /places")
     * @responseExample({
     *     "place": {
     *         "id": 144,
     *         "name": "Title",
     *         "placeId": "ChIJmatyUEl4GZURzf6ZZ20LvBw",
     *         "address": "Rua Ramiro Barcelos, 2350",
     *         "website": "http://www.hcpa.ufrgs.br/",
     *         "open_hours": "not available",
     *         "phone": "(51) 3359-8000",
     *         "qualityIndex": 10.2,
     *         "rankingPosition": 2,
     *         "rankingStatus": "up",
     *         "createdAt": "2016-02-23 00:00:00",
     *         "updatedAt": "2016-02-23 00:00:00",
     *     }
     * })
     */

    
    public function all()
    {
        $places = Place::find('1=1 limit 1');

        //$places = '';
         // echo '<pre>';
         // print_r($places);
         // echo '</pre>';

        return $this->respondCollection($places, new PlaceTransformer(), 'place');
    }

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
    public function find($product_id)
    {
        $product = Product::findFirst((int)$product_id);

        if (!$product) {
            throw new UserException(ErrorCodes::DATA_NOTFOUND, 'Product with id: #' . (int)$product_id . ' could not be found.');
        }

        return $this->respondItem($product, new ProductTransformer, 'product');
    }

    /**
     * @title("Create")
     * @description("Create a new product")
     * @response("Product object or Error object")
     * @requestExample({
     *      "title": "Title",
     *      "brand": "Brand name",
     *      "color": "green",
     *      "createdAt": "1427646703000",
     *      "updatedAt": "1427646703000"
     * })
     * @responseExample({
     *     "product": {
     *         "id": 144,
     *         "title": "Title",
     *         "brand": "Brand name",
     *         "color": "green",
     *         "createdAt": "1427646703000",
     *         "updatedAt": "1427646703000"
     *     }
     * })
     */
    public function create()
    {
        $data = $this->request->getJsonRawBody();

        $product = new Product;
        $product->assign((array)$data);

        if (!$product->save()) {
            throw new UserException(ErrorCodes::DATA_FAIL, 'Could not create product.');
        }

        return $this->respondItem($product, new ProductTransformer, 'product');
    }

    /**
     * @title("Update")
     * @description("Update a product")
     * @response("Product object or Error object")
     * @requestExample({
     *     "title": "Updated Title"
     * })
     * @responseExample({
     *     "product": {
     *         "id": 144,
     *         "title": "Updated Title",
     *         "brand": "Brand name",
     *         "color": "green",
     *         "createdAt": "1427646703000",
     *         "updatedAt": "1427646703000"
     *     }
     * })
     */
    public function update($product_id)
    {
        $product = Product::findFirst((int)$product_id);

        if (!$product) {
            throw new UserException(ErrorCodes::DATA_NOTFOUND, 'Could not find product.');
        }

        $data = $this->request->getJsonRawBody();
        $product->assign((array)$data);

        if (!$product->save()) {
            throw new UserException(ErrorCodes::DATA_FAIL, 'Could not update product.');
        }

        return $this->respondItem($product, new ProductTransformer, 'product');
    }

    /**
     * @title("Remove")
     * @description("Remove a product")
     * @response("Result object or Error object")
     * @responseExample({
     *     "result": "OK"
     * })
     */
    public function delete($product_id)
    {
        $product = Product::findFirst((int)$product_id);

        if (!$product) {
            throw new UserException(ErrorCodes::DATA_NOTFOUND, 'Could not find product.');
        }

        if (!$product->delete()) {
            throw new UserException(ErrorCodes::DATA_FAIL, 'Could not remove product.');
        }

        return $this->respondOK();
    }
}