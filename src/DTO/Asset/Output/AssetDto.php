<?php

declare(strict_types=1);

namespace App\DTO\Asset\Output;

use App\DTO\Asset\Input\LabelEnum;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class AssetDto
{
    #[Assert\NotBlank]
    public readonly int $id;

    #[Assert\NotBlank]
    #[SerializedName('label')]
    public readonly LabelEnum $label;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    #[SerializedName('value')]
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
        float $value,
        float $exchangeRate,
        float $valueInUSD
    ) {
        $this->id = $id;
        $this->label = $label;
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
