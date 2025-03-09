<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Laminas\Diactoros\ServerRequestFactory;
use NoFramework\HelloWorld;
use Relay\Relay;

use function DI\create;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAttributes(false);
$containerBuilder->addDefinitions([
    HelloWorld::class => create(HelloWorld::class)
]);

$container = $containerBuilder->build();

$middlewareQueue = [];

$requestHandler = new Relay($middlewareQueue);
$requestHandler->handle(ServerRequestFactory::fromGlobals());

$helloWorld = $container->get(HelloWorld::class);
$helloWorld->announce();
