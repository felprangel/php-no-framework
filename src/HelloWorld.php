<?php

declare(strict_types=1);

namespace NoFramework;

class HelloWorld
{
    public function __construct(private string $foo) {}

    public function __invoke(): void
    {
        echo "Hello, {$this->foo} world!";
        exit;
    }
}
