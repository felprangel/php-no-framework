<?php

namespace App;

use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    public function index(int $year): Response
    {
        if (self::isLeapYear($year)) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }

    private static function isLeapYear(?int $year = null): bool
    {
        if (null === $year) {
            $year = (int)date('Y');
        }

        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }
}