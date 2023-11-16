<?php

declare(strict_types=1);

namespace App\DTO\Asset\Hydrator;

use App\DTO\Asset\Input\AssetCollectionDto;
use App\Entity\Asset;
use App\Entity\User;

class AssetInputTransformer
{
    /**
     * @return Asset[]
     */
    public function transform(AssetCollectionDto $assetCollectionDto, User $user): array
    {
        $list = [];

        foreach ($assetCollectionDto->getAssetsDtos() as $asset) {
            $list[] = (new Asset())
                ->setLabel($asset->getLabel())
                ->setValue($asset->getValue())
                ->setOwner($user)
                ->setCurrencyId($asset->getCurrencyId())
                ->setCurrencyName($asset->getCurrencyName());
        }

        return $list;
    }
}
