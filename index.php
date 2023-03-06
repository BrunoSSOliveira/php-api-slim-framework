<?php

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Middleware\OutputBufferingMiddleware;
use Slim\App;

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->setBasePath('/apphs');

$chave = "Bearer -key-"

//  List Contacts

$app->get('/contacts/', function (Request $request, Response $response, $args) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/contacts/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'authorization: ' . $chave
    ),
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
});

//  Create Contacts

$app->post('/contacts/', function (Request $request, Response $response, $args) {

    $body = (string) $request->getBody();
    $jsonValue = json_encode(json_decode($body));
    // echo $jsonValue;
    // $response->getBody()->write(json_encode($body));
    // return $response;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/contacts/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonValue,
        CURLOPT_HTTPHEADER => array(
            'authorization: ' . $chave,
            'Content-Type: application/json'
        ),
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
});

//  Update Contacts

$app->patch('/contacts/{contactid}', function ($request, $response, array $args) {
   
    $contactid = $args['contactid'];
    $body = (string) $request->getBody();
    $jsonValue = json_encode(json_decode($body));
    echo "Contact ID: " . $contactid;
    echo "json: " . $jsonValue;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/contacts/' . $contactid,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PATCH',
        CURLOPT_POSTFIELDS => $jsonValue,
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $chave,
            'Content-Type: application/json'
        ),
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

});

//  Create Companies

$app->post('/companies/', function (Request $request, Response $response, $args) {

    $body = (string) $request->getBody();
    $jsonValue = (string) json_encode(json_decode($body));

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/companies',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonValue,
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $chave,
            'Content-Type: application/json'
        ),
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
});

$app->put('/contacts/{contactid}/associations/{objecttype}/{objectid}/{associationtype}', function ($request, $response, array $args) {

    $contactid = $args['contactid'];
    $objecttype = $args['objecttype'];
    $objectid = $args['objectid'];
    $associationtype = $args['associationtype'];
    echo "Contact ID: " . $contactid;
    echo "\n Object Type: " . $objecttype;
    echo "\n Object ID: " . $objectid;
    echo "\n Association Type: " . $associationtype;
    echo "\n" ;
    echo "\n" ;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.hubapi.com/crm/v3/objects/contacts/".$contactid."/associations/".$objecttype."/".$objectid."/".$associationtype,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $chave
        ),
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

});


$app->run();

?>