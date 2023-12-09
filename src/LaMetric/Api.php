<?php

declare(strict_types=1);

namespace LaMetric;

use Binance\API as BinanceAPI;
use LaMetric\Helper\IconHelper;
use LaMetric\Helper\PriceHelper;
use LaMetric\Helper\SymbolHelper;
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

        $wallets = [];

        if (isset($account['balances'])) {
            foreach ($account['balances'] as $balance) {
                if ($balance['free'] > 0 || $balance['locked'] > 0) {
                    if (isset($prices[$balance['asset']])) {
                        $asset = $prices[$balance['asset']];

                        $binanceBalance = $balance['free'] + $balance['locked'];
                        if ($parameters['separate-assets'] === 'false') {
                            if (!isset($wallets['ALL'])) {
                                $wallets['ALL'] = 0;
                            }
                            $wallets['ALL'] += $asset['price'] * $binanceBalance;
                        } else {
                            $price = $asset['price'] * $binanceBalance;
                            if (($price > 1 && $parameters['hide-small-assets'] === 'true') || $parameters['hide-small-assets'] === 'false') {
                                $wallets[$balance['asset']] = $price;
                            }
                        }
                    }
                }
            }
        }

        foreach ($wallets as &$wallet) {

            $wallet = match ($parameters['position']) {
                'hide' => PriceHelper::round($wallet),
                'after' => PriceHelper::round($wallet) . SymbolHelper::getSymbol($parameters['currency']),
                default => SymbolHelper::getSymbol($parameters['currency']) . PriceHelper::round($wallet),
            };
        }

        return $this->mapData($wallets);
    }

    private function mapData(array $data = []): FrameCollection
    {
        $frameCollection = new FrameCollection();

        foreach ($data as $key => $wallet) {
            $frame = new Frame();
            $frame->setText((string) $wallet);
            $frame->setIcon(IconHelper::getIcon($key));

            $frameCollection->addFrame($frame);
        }

        return $frameCollection;
    }
}
