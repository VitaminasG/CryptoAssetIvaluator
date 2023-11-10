<?php

namespace App\DTO\Asset\Input;

enum CurrencyIdEnum: string implements AssetInputInterface
{
    case BTC = 'btc-bitcoin';
    case ETH = 'eth-ethereum';
    case IOTA = 'miota-iota';
}
