<?php

declare(strict_types=1);

namespace App\DTO\Asset\Hydrator;

use App\DTO\Asset\Output\AssetDTO;
use App\Entity\Asset;
use Doctrine\Common\Collections\Collection;

class AssetOutputTransformer
{
    /**
     * @param Collection<int, Asset> $assets
     *
     * @return AssetDTO[]
     */
    public function transform(Collection $assets): array
    {
        $list = [];

        foreach ($assets as $asset) {
            $list[] = $this->getAssetDTO($asset);
        }

        return $list;
    }

    private function getAssetDTO(Asset $asset): AssetDTO
    {
        return new AssetDTO(
            $asset->getId(),
            $asset->getLabel(),
            $asset->getCurrency(),
            $asset->getValue(),
            0.00,
            0.00
        );
    }
}