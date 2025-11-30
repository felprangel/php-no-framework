<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
$response = new Response();

$pagesDirPath = __DIR__ . '/../src/pages';

$map = [
    '/hello' => $pagesDirPath . '/hello.php',
    '/bye' => $pagesDirPath . '/bye.php'
];

$path = $request->getPathInfo();

if (isset($map[$path])) {
    require $map[$path];
    $response->send();
    return;
}

$response->setStatusCode(404);
$response->setContent('Not Found');
$response->send();
