<?php

namespace App\DTO\Asset\Input;

enum LabelEnum: string implements AssetInputInterface
{
    case BINANCE = 'binance';
    case USB = 'usb stick';
}
