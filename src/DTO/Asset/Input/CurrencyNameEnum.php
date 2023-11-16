<?php

namespace App\DTO\Asset\Input;

enum CurrencyNameEnum: string implements AssetInputInterface
{
    case BTC = 'BTC';
    case ETH = 'ETH';
    case IOTA = 'IOTA';
}
