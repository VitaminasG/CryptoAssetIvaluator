<?php

declare(strict_types=1);

namespace App\DTO\Asset\Resolver\Input;

use App\DTO\Asset\Input\AssetCollectionDto;
use App\DTO\Asset\Input\AssetDto;
use App\DTO\Asset\Input\AssetInputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AssetCollectionValueResolver implements ValueResolverInterface, AssetValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();

        if (!$argumentType || !is_subclass_of($argumentType, AssetInputInterface::class)) {
            return [];
        }

        yield new AssetCollectionDto(
            $this->getAssets(
                $request->getContent()
            )
        );
    }

    public function getSerializer(): Serializer
    {
        $normalizers = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(),
        ];

        return new Serializer(
            $normalizers,
            [new JsonEncoder(null, null, [JSON_FORCE_OBJECT])]
        );
    }

    private function getAssets(string $content): array
    {
        return $this->getSerializer()->deserialize(
            $content,
            AssetDto::class.'[]',
            'json'
        );
    }
}
