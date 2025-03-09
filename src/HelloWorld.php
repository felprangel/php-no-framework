<?php

declare(strict_types=1);

namespace NoFramework;

class HelloWorld
{
    public function announce(): void
    {
        echo "Hello autoload world!";
    }

    public function __invoke(): void
    {
        echo 'Hello, autoloaded world!';
        exit;
    }
}
