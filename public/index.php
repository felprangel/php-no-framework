<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequestFactory;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use NoFramework\HelloWorld;
use Relay\Relay;

use function DI\create;
use function DI\get;
use function FastRoute\simpleDispatcher;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAttributes(false);

$containerBuilder->addDefinitions([
    HelloWorld::class => create(HelloWorld::class)
        ->constructor(get('Foo'), get('Response')),
    'Foo' => 'bar',
    'Response' => function () {
        return new Response();
    }
]);

$container = $containerBuilder->build();

$routes = simpleDispatcher(function (RouteCollector $route) {
    $route->get('/hello', HelloWorld::class);
});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);


$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();
return $emitter->emit($response);
