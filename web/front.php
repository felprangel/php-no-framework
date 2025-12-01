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
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    include sprintf(__DIR__.'/../src/pages/%s.php', $map[$path]);
    $response = new Response(ob_get_clean());
    $response->send();
    return;
}

$response = new Response('Not Found', 404);
$response->send();
