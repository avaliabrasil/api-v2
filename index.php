<?php
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Http\Response;

// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/models/'
    )
)->register();

$di = new FactoryDefault();

// Set up the database service
$di->set('db', function () {
    return new PdoMysql(
        array(
            "host"     => "127.0.0.1",
            "username" => "root",
            "password" => "root",
            "dbname"   => "avaliabrasil_dev"
        )
    );
});

// Create and bind the DI to the application
$app = new Micro($di);






// Retrieves all robots


// Retrieves all robots
$app->get('/api/places', function () use ($app) {

    $phql = "SELECT * FROM place ORDER BY name";
    $places = $app->modelsManager->executeQuery($phql);

    $data = array();
    foreach ($places as $place) {
        $data[] = array(
            'id'   => $place->id,
            'name' => $place->name,
            'place_id' => $place->place_id,
        );
    }
    echo json_encode($data);
});

// Retrieves place based on google place id
$app->get('/api/place/{place_id:}', function ($place_id) use ($app) {

    $phql = "SELECT * FROM place WHERE place_id = :place_id:";
    $place = $app->modelsManager->executeQuery($phql, array(
        'place_id' => $place_id
    ))->getFirst();

    // Create a response
    $response = new Response();

    if ($place == false) {
        $response->setJsonContent(
            array(
                'status' => 'NOT-FOUND'
            )
        );
    } else {
        $response->setJsonContent(
            array(
                'place'   => array(
                    'id'   => $place->id,
                    'name' => $place->name,
                    'placeId' => $place->place_id,
                    'qualityIndex' => 10.2,
                    'rankingPosition' => 2,
                    'rankingStatus' => 'up'
                )
            )
        );
    }

    return $response;
});


// Searches for robots with $name in their name

/*
$app->get('/api/robots/search/{name}', function ($name) {
	echo 'banha';
});

// Retrieves robots based on primary key
$app->get('/api/robots/{id:[0-9]+}', function ($id) {

});

// Adds a new robot
$app->post('/api/robots', function () {

});

// Updates robots based on primary key
$app->put('/api/robots/{id:[0-9]+}', function () {

});

// Deletes robots based on primary key
$app->delete('/api/robots/{id:[0-9]+}', function () {

});*/






// Adds a new robot
$app->post('/api/places', function () use ($app) {

    $robot = $app->request->getJsonRawBody();

    $phql = "INSERT INTO place (id_type, name, status, id_city, place_id) VALUES (:id_type:, :name:, :status:, :id_city:, :place_id:)";
    echo $phql;
    $status = $app->modelsManager->executeQuery($phql, array(
        'id_type' => $robot->id_type,
        'name' => $robot->name,
        'status' => $robot->status,
        'id_city' => $robot->id_city,
        'place_id' => $robot->place_id
    ));

    // Create a response
    $response = new Response();

    // Check if the insertion was successful
    if ($status->success() == true) {

        // Change the HTTP status
        $response->setStatusCode(201, "Created");

        $robot->id = $status->getModel()->id;

        $response->setJsonContent(
            array(
                'status' => 'OK',
                'data'   => $robot
            )
        );

    } else {

        // Change the HTTP status
        $response->setStatusCode(409, "Conflict");

        // Send errors to the client
        $errors = array();
        foreach ($status->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }

        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $errors
            )
        );
    }

    return $response;
});



$app->handle();

