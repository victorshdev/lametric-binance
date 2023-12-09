<?php

declare(strict_types=1);

namespace LaMetric;

use Binance\API as BinanceAPI;
use LaMetric\Response\Frame;
use LaMetric\Response\FrameCollection;

class Api
{
    public function fetchData(array $parameters = []): FrameCollection
    {
        $api = new BinanceAPI(
            $parameters['api-key'],
            $parameters['secret-key']
        );

        $prices = PriceSource::get($api);

        $account = $api->account();

        $totalBalance = 0;

        if (isset($account['balances'])) {
            foreach ($account['balances'] as $balance) {
                if ($balance['free'] > 0 || $balance['locked'] > 0) {
                    if (isset($prices[$balance['asset']])) {
                        $asset = $prices[$balance['asset']];

                        $binanceBalance = $balance['free'] + $balance['locked'];

                        $totalBalance += $asset['price'] * $binanceBalance;
                    }
                }
            }
        }

        return $this->mapData(number_format($totalBalance, 2), $parameters);
    }

    private function mapData(string $totalBalance, array $parameters = []): FrameCollection
    {
        $frameCollection = new FrameCollection();

        $frame = new Frame();
        $frame->setStart(floatval($parameters['start']));
        $frame->setEnd(floatval($parameters['end']));
        $frame->setCurrent($totalBalance);
        $frame->setIcon('8442');

        $frameCollection->addFrame($frame);

        return $frameCollection;
    }
}
