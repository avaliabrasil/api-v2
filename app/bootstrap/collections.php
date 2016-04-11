<?php

$app->mount(new \PhalconRest\Collection\ResourceCollection);
$app->mount(new ExportCollection);
$app->mount(new PlaceCollection);
$app->mount(new PlaceDetailCollection);
$app->mount(new UserCollection);
$app->mount(new CityCollection);
$app->mount(new StateCollection);
$app->mount(new RegionCollection);