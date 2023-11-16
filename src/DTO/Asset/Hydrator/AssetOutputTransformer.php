<?php

declare(strict_types=1);

namespace App\DTO\Asset\Hydrator;

use App\Client\Decorator\ExchangeRateProvider;
use App\DTO\Asset\Output\AssetDto;
use App\DTO\Asset\Output\AssetTotalDto;
use App\Entity\Asset;
use Doctrine\Common\Collections\Collection;

class AssetOutputTransformer
{
    private const DEFAULT_TOTAL_VALUE = 0.00;

    private ExchangeRateProvider $exchangeRateClient;

    public function __construct(ExchangeRateProvider $exchangeRateClient)
    {
        $this->exchangeRateClient = $exchangeRateClient;
    }

    /**
     * @param Collection<int, Asset> $assets
     *
     * @return AssetDto[]
     */
    public function transform(Collection $assets): array
    {
        $sortedList = [];

        foreach ($assets as $asset) {
            $sortedList[$asset->getCurrencyName()->value][] = $asset;
        }

        return $this->getFinalList($sortedList);
    }

    /**
     * @param array<string, array<int, Asset>> $sortedList
     *
     * @return AssetTotalDto[]
     */
    private function getFinalList(array $sortedList): array
    {
        $list = [];

        foreach ($sortedList as $currencyName => $assets) {
            $total = self::DEFAULT_TOTAL_VALUE;

            foreach ($assets as $asset) {
                $total += $asset->getValue();
            }

            $list[] = $this->getAssetTotalDto($currencyName, $total, $assets);
        }

        return $list;
    }

    /**
     * @param Asset[] $assets
     */
    private function getAssetTotalDto(string $currencyName, float $total, array $assets): AssetTotalDto
    {
        return new AssetTotalDto(
            $currencyName,
            $total,
            $this->getAssetDtoList($assets)
        );
    }

    /**
     * @param Asset[] $assets
     *
     * @return AssetDto[]
     */
    private function getAssetDtoList(array $assets): array
    {
        $list = [];

        foreach ($assets as $asset) {
            $list[] = $this->getAssetDto($asset);
        }

        return $list;
    }

    private function getAssetDto(Asset $asset): AssetDto
    {
        $exchangeDto = $this->exchangeRateClient->getExchange(
            $asset->getCurrencyId()->value
        );

        $valueInUSD = round(
            $asset->getValue() * $exchangeDto->getClose(),
            2
        );

        return new AssetDto(
            $asset->getId(),
            $asset->getLabel(),
            $asset->getValue(),
            round($exchangeDto->getClose(), 2),
            $valueInUSD
        );
    }
}
