<?php

declare(strict_types=1);

namespace App\DTO\Asset\Input;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class AssetDto implements AssetInputInterface
{
    #[Assert\NotBlank]
    public readonly LabelEnum $label;

    #[Assert\NotBlank]
    public readonly CurrencyNameEnum $currencyName;

    #[Assert\NotBlank]
    #[SerializedName('currencyId')]
    public readonly CurrencyIdEnum $currencyId;

    public function __construct(
        string $label,
        string $currencyName,
        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        #[SerializedName('value')]
        public float $value,
        string $currencyId
    ) {
        $this->label = LabelEnum::from($label);
        $this->currencyName = CurrencyNameEnum::from($currencyName);
        $this->currencyId = CurrencyIdEnum::from($currencyId);
    }

    public function getLabel(): LabelEnum
    {
        return $this->label;
    }

    public function getCurrencyName(): CurrencyNameEnum
    {
        return $this->currencyName;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getCurrencyId(): CurrencyIdEnum
    {
        return $this->currencyId;
    }
}
