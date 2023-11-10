<?php

namespace App\DTO\Asset\Input;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

class AssetCollectionDto implements AssetInputInterface
{
    #[Assert\Count(
        min: 1,
        minMessage: 'Must be at least one asset presented'
    )]
    public Collection $assets;

    public function __construct(array $assets)
    {
        $this->assets = new ArrayCollection($assets);
    }
}
