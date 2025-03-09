<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use Laminas\Diactoros\ServerRequestFactory;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use NoFramework\HelloWorld;
use Relay\Relay;

use function DI\create;
use function FastRoute\simpleDispatcher;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAttributes(false);
$containerBuilder->addDefinitions([
    HelloWorld::class => create(HelloWorld::class)
]);

$container = $containerBuilder->build();

$routes = simpleDispatcher(function (RouteCollector $route) {
    $route->get('/hello', HelloWorld::class);
});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler();


$requestHandler = new Relay($middlewareQueue);
$requestHandler->handle(ServerRequestFactory::fromGlobals());

$helloWorld = $container->get(HelloWorld::class);
$helloWorld->announce();
