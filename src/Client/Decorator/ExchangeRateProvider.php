<?php

declare(strict_types=1);

namespace App\Client\Decorator;

use App\Client\CoinClient;
use App\DTO\Asset\Input\ChannelTimeTypeEnum;
use App\DTO\Asset\Input\ChannelTypeEnum;
use App\DTO\Asset\Input\CurrencyTypeEnum;
use App\DTO\Asset\Input\ExchangeRateDto;
use JsonException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ExchangeRateProvider extends CoinClient
{
    /**
     * @throws BadRequestException
     */
    public function getExchange(string $currencyId): ExchangeRateDto
    {
        try {
            $jsonResponse = $this->getJsonResponse(
                $currencyId,
                (ChannelTypeEnum::OHLCV)->toString(),
                (ChannelTimeTypeEnum::TODAY)->toString(),
                (CurrencyTypeEnum::DEFAULT)->toString()
            );

            $exchangeRates =  $this->getSerializer()->deserialize(
                $jsonResponse,
                ExchangeRateDto::class. '[]',
                'json'
            );

            return reset($exchangeRates);
        } catch (JsonException|TransportExceptionInterface|ServerExceptionInterface
        |ClientExceptionInterface|RedirectionExceptionInterface $exception) {
            throw new BadRequestException($exception->getMessage());
        }
    }
}