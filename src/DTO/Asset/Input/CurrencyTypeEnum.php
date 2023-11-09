<?php

namespace App\DTO\Asset\Input;

enum CurrencyTypeEnum: string
{
    case DEFAULT = 'usd';
    case EMPTY = '';
    case EUR = 'eur';
    case GBP = 'gbp';
    case UAH = 'uah';

    public function toString(): string
    {
        return $this->value;
    }
}
