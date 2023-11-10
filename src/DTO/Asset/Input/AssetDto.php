<?php

declare(strict_types=1);

namespace App\DTO\Asset\Input;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Type;

final class AssetDto implements AssetInputInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[SerializedName('label')]
        #[Type('string')]
        public readonly string $label,
        #[Assert\NotBlank]
        #[SerializedName('currencyName')]
        #[Type('string')]
        public readonly string $currencyName,
        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        #[SerializedName('value')]
        #[Type('float')]
        public readonly float $value,
        #[Assert\NotBlank]
        #[SerializedName('currencyId')]
        #[Type('string')]
        public readonly string $currencyId
    ) {
    }
}
