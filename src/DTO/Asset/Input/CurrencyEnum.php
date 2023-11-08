<?php

namespace App\DTO\Asset\Input;

enum CurrencyEnum: string
{
    case BTC = 'BTC';
    case ETH = 'ETH';
    case IOTA = 'IOTA';
}
