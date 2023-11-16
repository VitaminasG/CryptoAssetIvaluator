<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Asset\Hydrator\AssetInputTransformer;
use App\DTO\Asset\Input\AssetCollectionDto;
use App\Entity\User;
use App\Repository\UserRepository;

class AssetDeleteService
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

    public function delete(AssetCollectionDto $assetCollectionDto, User $user): void
    {
        foreach ($this->assetInputTransformer->transform($assetCollectionDto, $user) as $asset) {
            foreach ($user->getAssets() as $key => $savedAsset) {
                if ($savedAsset->isEqualTo($asset)) {
                    $user->getAssets()->remove($key);
                    break;
                }
            }
        }

        $this->userRepository->save($user);
    }
}
