<?php

declare(strict_types=1);

namespace App\DTO\Asset\Output;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class AssetTotalDto
{
    #[Assert\NotBlank]
    #[SerializedName('currencyName')]
    public readonly string $currencyName;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    #[SerializedName('total')]
    public readonly float $total;

    /**
     * @var AssetDto[] $assets
     */
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    #[SerializedName('assets')]
    public readonly array $assets;

    public function __construct(
        string $currencyName,
        float $total,
        array $assets
    ) {
        $this->currencyName = $currencyName;
        $this->total = $total;
        $this->assets = $assets;
    }

    public function getCurrencyName(): string
    {
        return $this->currencyName;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getAssets(): array
    {
        return $this->assets;
    }
}
