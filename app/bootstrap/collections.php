<?php

$app->mount(new \PhalconRest\Collection\ResourceCollection);
$app->mount(new ExportCollection);
$app->mount(new PlaceCollection);
$app->mount(new PlaceDetailCollection);
$app->mount(new UserCollection);