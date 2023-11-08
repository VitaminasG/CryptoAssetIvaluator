<?php

namespace App\DTO\Asset\Input;

enum CurrencyNameEnum: string
{
    case BTC = 'BTC';
    case ETH = 'ETH';
    case IOTA = 'IOTA';
}
