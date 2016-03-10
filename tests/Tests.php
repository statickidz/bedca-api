<?php

require_once '../vendor/autoload.php';

use StaticKidz\BedcaAPI\BedcaClient;

header('Content-Type: text/xml; charset=utf-8');

$client = new BedcaClient();


echo $client->getFood(893, true);