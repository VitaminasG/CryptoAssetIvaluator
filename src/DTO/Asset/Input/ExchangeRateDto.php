<?php

declare(strict_types=1);

namespace App\DTO\Asset\Input;

use Symfony\Component\Serializer\Annotation\SerializedName;

final class ExchangeRateDto
{
    public function __construct(
        #[SerializedName('time_open')]
        public readonly string $timeOpen,
        #[SerializedName('time_close')]
        public readonly string $timeClose,
        #[SerializedName('open')]
        public readonly float $open,
        #[SerializedName('high')]
        public readonly float $high,
        #[SerializedName('low')]
        public readonly float $low,
        #[SerializedName('close')]
        public readonly float $close,
        #[SerializedName('volume')]
        public readonly float $volume,
        #[SerializedName('market_cap')]
        public readonly float $marketCap
    ) {
    }

    public function getTimeOpen(): string
    {
        return $this->timeOpen;
    }

    public function getTimeClose(): string
    {
        return $this->timeClose;
    }

    public function getOpen(): float
    {
        return $this->open;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function getLow(): float
    {
        return $this->low;
    }

    public function getClose(): float
    {
        return $this->close;
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function getMarketCap(): float
    {
        return $this->marketCap;
    }
}
