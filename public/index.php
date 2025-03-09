<?php

declare(strict_types=1);

use NoFramework\HelloWorld;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$helloWorld = new HelloWorld();
$helloWorld->announce();
