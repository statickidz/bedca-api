<?php

require_once '../vendor/autoload.php';

use StaticKidz\BedcaAPI\BedcaClient;

header('Content-Type: text/html; charset=utf-8');

$client = new BedcaClient();

//echo $client->getFood(893, true);

echo "<pre>";
var_dump($client->getFoodGroups());
echo "</pre>";