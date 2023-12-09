<?php

namespace LaMetric;

class PriceSource
{
    public static function get(\Binance\API $api): array
    {
        $prices = array_filter($api->bookPrices(), function ($price, $key) {
            return strpos($key, 'USDT');
        }, ARRAY_FILTER_USE_BOTH);

        $result = [];

        array_walk($prices, function ($values, $symbol) use (&$result) {
            $ask = floatval($values['ask']);
            $bid = floatval($values['bid']);
            $value = ($ask + $bid) / 2;

            $cryptoSymbol = str_replace("USDT", "", $symbol);
            $result[$cryptoSymbol] = ['price' => $value];
        });

        $prices = $result;
        $prices['USDT'] = ['price' => 1];

        return $prices;
    }
}