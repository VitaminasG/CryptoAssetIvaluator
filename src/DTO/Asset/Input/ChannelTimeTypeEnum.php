<?php

namespace App\DTO\Asset\Input;

enum ChannelTimeTypeEnum: string
{
    case TODAY = 'today';
    case HISTORICAL = 'historical';
    case EMPTY = '';

    public function toString(): string
    {
        return $this->value;
    }
}
