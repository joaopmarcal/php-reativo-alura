<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Psr\Http\Message\ResponseInterface;

require_once "vendor/autoload.php";

$client = new Client();

$promisse_one = $client->getAsync("http://localhost:8080/http-server.php");
$promisse_two = $client->getAsync("http://localhost:8000/http-server.php");

/** @var ResponseInterface[] $response */

$response = Utils::unwrap([
    $promisse_one, $promisse_two
]);

echo "Resposta 1: " . $response[0]->getBody()->getContents();
echo "Resposta 2: " . $response[1]->getBody()->getContents();