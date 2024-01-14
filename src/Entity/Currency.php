<?php

namespace App\Entity;

class Currency
{
    private static $currencies = [
        'CZK',
        'USD',
        'EUR'
    ];

    public static function getCurrencyList() {
        return array_combine(self::$currencies, self::$currencies);
    }
}