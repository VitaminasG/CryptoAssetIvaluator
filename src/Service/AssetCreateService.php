<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Asset\Hydrator\AssetInputTransformer;
use App\DTO\Asset\Input\AssetCollectionDto;
use App\Entity\User;
use App\Repository\UserRepository;

class AssetCreateService
{
    private UserRepository $userRepository;
    private AssetInputTransformer $assetInputTransformer;

    public function __construct(
        UserRepository $userRepository,
        AssetInputTransformer $assetInputTransformer
    ) {
        $this->userRepository = $userRepository;
        $this->assetInputTransformer = $assetInputTransformer;
    }

    public function create(AssetCollectionDto $assetCollectionDto, User $user): void
    {
        foreach ($this->assetInputTransformer->transform($assetCollectionDto, $user) as $asset) {
            $user->addAsset($asset);
        }

        $this->userRepository->save($user);
    }
}
