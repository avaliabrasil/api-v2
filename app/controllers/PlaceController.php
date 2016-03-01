<?php

use PhalconRest\Constants\ErrorCodes as ErrorCodes;
use PhalconRest\Exceptions\UserException;

/**
 * @resource("Place")
 */
class PlaceController extends \App\Mvc\Controller
{
    public function test() {
        $google_id = 'ChIJmatyUEl4GZURzf6ZZ20LvBw'; //HPS Googleid


        $cidade = 'Porto Alegre';
        $estado = 'RS';

        // $place = Place::findFirst([
        //     'conditions' => 'google_id = :google_id:',
        //     'bind' => ['google_id' => $google_id]
        // ])->toArray();


        //$state = State::findFirst("letter = 'RS'")->toArray();
        //$city  = City::find("title like '%Porto%' and id_state=1")->toArray();

        $robot = Place::findFirstByTitle('Porto Alegre')->toArray();



        print_r($robot);
        die('.');


        $city = City::findFirst('name = "Shinichi Osawa"');



        // $data = 
        // return [
        //     'id'             => 'id',
        //     'id_type'        => 'id_type',
        //     'name'           => 'name',
        //     'google_id'      => 'google_id',
        //     'id_city'        => 'id_city',
        //     'status'         => 'status',
        //     'created_at'     => 'created_at',
        //     'updated_at'     => 'updated_at'
        // ];
        

        print_r($data);
        //die('dieeeee');

        $place = new Place;
        $place->assign((array)$data);

        if (!$place->save()) {
            throw new UserException(ErrorCodes::DATA_FAIL, 'Could not create place.');
        }

        return $this->respondItem($place, new PlaceTransformer, 'place');


        return $place;
    }






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

    public function findByName($name)
    {
        $places = Place::find(
            array(
            "conditions" => "name LIKE '%" . $name . "%'",
        ));
        return $this->respondCollection($places, new PlaceTransformer(), 'place');
    }

    
    public function all()
    {
        $places = Place::find();

        //print_r($places->City);

        //$places = '';
         // echo '<pre>';
         // print_r($places);
         // echo '</pre>';
        //$city = new City;
        //print_r($city->findFirst(1));

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
    public function find($google_id)
    {

        //search place with google id where
        $place = Place::findFirst([
            'conditions' => 'google_id = :google_id:',
            'bind' => ['google_id' => $google_id]
        ]);


        foreach ($place->Teste as $c) {
            echo 'teste';
        }

die('.');
        echo '<pre>';
            print_r($place->getCityName());
        echo '</pre>';

        if (!$place) {
            //throw new UserException(ErrorCodes::DATA_NOTFOUND, 'Place with google_id: ' . $google_id . ' could not be found.');

            //if place doesn't exists in avb database, save new place.
            $GAPIKEY = 'AIzaSyAK2M_BGN4hWEYVVhx9OaDPjafcZEBdAy0';
            $url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid='.$google_id.'&key='.$GAPIKEY;
            $gjson = json_decode(file_get_contents($url), true);
            

            $gresult = $gjson['result'];
            //print_r($gresult);
            
        //     $data = [
            
        //     'name' => $gresult['name'],
        //     'google_id' => $google_id,
        //     'id_type' => 5,
        //     'id_city' => 4927,
        //     'status' => 6,
        // ];
            
            $data = array(
                'id_type'       => 5,
                'name'          => $gresult['name'],
                'status'        => 6,
                'id_city'       => 4927,
                'google_id'     => $google_id
            );

            
            
            $new_place = new Place;
            $new_place->assign($data);

            


            echo ($new_place->save());
die('test');            



            if (!$new_place->save()) {
                throw new UserException(ErrorCodes::DATA_FAIL, 'Could not create place.');
            }
            return $this->respondItem($new_place, new PlaceTransformer, 'place');
        

        } else {
            return $this->respondItem($place, new PlaceTransformer, 'place');
        }
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
        

        print_r($data);
        //die('dieeeee');

        $place = new Place;
        $place->assign((array)$data);

        if (!$place->save()) {
            throw new UserException(ErrorCodes::DATA_FAIL, 'Could not create place.');
        }

        return $this->respondItem($place, new PlaceTransformer, 'place');
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
}