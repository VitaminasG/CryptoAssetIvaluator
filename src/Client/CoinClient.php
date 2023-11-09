<?php

declare(strict_types=1);

namespace App\Client;

use App\DTO\Asset\Input\ChannelTimeTypeEnum;
use App\DTO\Asset\Input\ChannelTypeEnum;
use App\DTO\Asset\Input\CurrencyTypeEnum;
use JsonException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CoinClient
{
    private string $domain;
    private HttpClientInterface $client;

    public function __construct(
        string $apiCoinPaprikaDomain,
        HttpClientInterface $client
    ) {
        $this->domain = $apiCoinPaprikaDomain;
        $this->client = $client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function getJsonResponse(
        string $currencyId,
        string $channelType = null,
        string $channelTimeType = null,
        string $currencyType = null
    ): string {
        try {
            $response = $this->client->request(
                Request::METHOD_GET,
                $this->getUrl(
                    $currencyId,
                    $channelType,
                    $channelTimeType,
                    $currencyType
                )
            );
        } catch (TransportExceptionInterface $exception) {
            throw new RuntimeException($exception->getMessage());
        }

        return $response->getContent();
    }

    protected function getUrl(
        string $currencyId,
        string $channelType = null,
        string $channelTimeType = null,
        string $currencyType = null
    ):string {
        return $this->getDomain()
            . '/'
            . $currencyId
            . $this->getChannelType($channelType)
            . $this->getChannelTimeType($channelTimeType)
            . $this->getCurrencyType($currencyType);
    }

    protected function getSerializer(): Serializer
    {
        $normalizers = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter()),
        ];

        return new Serializer(
            $normalizers,
            [new JsonEncoder()]
        );

//        return new Serializer(
//            [
//                $normalizer,
//                new ArrayDenormalizer()
//            ],
//            [new JsonEncoder()]
//        );
    }

    protected function getDomain(): string
    {
        return $this->domain;
    }

    protected function getChannelType(string $channelType = null): string
    {
        return '/' . $channelType ?: (ChannelTypeEnum::EMPTY)->toString();
    }

    protected function getChannelTimeType(string $channelTimeType = null): string
    {
        return '/' . $channelTimeType ?: (ChannelTimeTypeEnum::EMPTY)->toString();
    }

    protected function getCurrencyType(string $currencyType = null): string
    {
        return '?quotes=' . $currencyType ?: (CurrencyTypeEnum::EMPTY)->toString();
    }
}
