<?php

declare(strict_types=1);

namespace LaMetric;

use Binance\API as BinanceAPI;
use LaMetric\Response\Frame;
use LaMetric\Response\FrameCollection;
use LaMetric\Response\GoalFrame;

class Api
{
    public function fetchData(array $parameters = []): FrameCollection
    {
        $api = new BinanceAPI(
            $parameters['api-key'],
            $parameters['secret-key']
        );

        $api->caOverride = true;

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

        return $this->mapData(intval($totalBalance), $parameters);
    }

    private function mapData(int $totalBalance, array $parameters = []): FrameCollection
    {
        $frameCollection = new FrameCollection();

        $frame = new Frame();
        $frame->setText($totalBalance . '$');
        $frame->setIcon('8442');
        $frameCollection->addFrame($frame);

        $percent = intval($totalBalance/floatval($parameters['end'])*100);

        $goal = new GoalFrame();
        $goal->setStart(0);
        $goal->setEnd(100);
        $goal->setCurrent($percent);
        $goal->setIcon('8442');
        $frameCollection->addFrame($goal);

        return $frameCollection;
    }
}
