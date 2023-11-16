<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Asset\Hydrator\AssetInputTransformer;
use App\DTO\Asset\Input\AssetCollectionDto;
use App\Entity\User;
use App\Repository\UserRepository;

class AssetUpdateService
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

    public function update(AssetCollectionDto $assetCollectionDto, User $user): void
    {
        foreach ($this->assetInputTransformer->transform($assetCollectionDto, $user) as $asset) {
            foreach ($user->getAssets() as $savedAsset) {
                if ($savedAsset->isEqualTo($asset)) {
                    $savedAsset->setValue(
                        $savedAsset->getValue() + $asset->getValue()
                    );
                    break;
                }
            }
        }

        $this->userRepository->save($user);
    }
}
