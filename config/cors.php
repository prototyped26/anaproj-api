<?php
/**
 * Created by PhpStorm.
 * User: edlly
 * Date: 19/09/2018
 * Time: 17:01
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    //'allowedHeaders' => ['Produit-Type', 'X-Requested-With', 'Authorization', 'Access-Control-Allow-Origin'],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposedHeaders' => [],
    'maxAge' => 0,
];

