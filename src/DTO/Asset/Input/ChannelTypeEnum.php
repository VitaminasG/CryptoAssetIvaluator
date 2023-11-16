<?php

namespace App\DTO\Asset\Input;

enum ChannelTypeEnum: string implements AssetInputInterface
{
    case OHLCV = 'ohlcv';
    case EVENTS = 'events';
    case EMPTY = '';

    public function toString(): string
    {
        return $this->value;
    }
}
