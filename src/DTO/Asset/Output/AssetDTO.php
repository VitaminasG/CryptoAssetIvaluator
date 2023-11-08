<?php

declare(strict_types=1);

namespace App\DTO\Asset\Output;

use App\DTO\Asset\Input\CurrencyEnum;
use App\DTO\Asset\Input\LabelEnum;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class AssetDTO
{
    #[Assert\NotBlank]
    public readonly int $id;

    #[Assert\NotBlank]
    public readonly LabelEnum $label;

    #[Assert\NotBlank]
    public readonly CurrencyEnum $currency;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public readonly float $value;

    #[Assert\NotBlank]
    #[SerializedName('exchangeRate')]
    public readonly float $exchangeRate;

    #[Assert\NotBlank]
    #[SerializedName('valueInUSD')]
    public readonly float $valueInUSD;

    public function __construct(
        int $id,
        LabelEnum $label,
        CurrencyEnum $currency,
        float $value,
        float $exchangeRate,
        float $valueInUSD
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->currency = $currency;
        $this->value = $value;
        $this->exchangeRate = $exchangeRate;
        $this->valueInUSD = $valueInUSD;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLabel(): LabelEnum
    {
        return $this->label;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getExchangeRate(): float
    {
        return $this->exchangeRate;
    }

    public function getValueInUSD(): float
    {
        return $this->valueInUSD;
    }
}
