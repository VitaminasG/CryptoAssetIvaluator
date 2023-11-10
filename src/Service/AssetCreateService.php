<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Asset\Hydrator\AssetInputTransformer;
use App\DTO\Asset\Input\AssetCollectionDto;
use App\Entity\User;
use App\Repository\AssetRepository;

class AssetCreateService
{
    private AssetRepository $assetRepository;
    private AssetInputTransformer $assetInputTransformer;

    public function __construct(
        AssetRepository $assetRepository,
        AssetInputTransformer $assetInputTransformer
    ) {
        $this->assetRepository = $assetRepository;
        $this->assetInputTransformer = $assetInputTransformer;
    }

    public function create(AssetCollectionDto $assetCollectionDto, User $user): void
    {
        foreach ($this->assetInputTransformer->transform($assetCollectionDto, $user) as $asset) {
            $this->assetRepository->save($asset);
        }
    }
}
