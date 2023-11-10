<?php

namespace App\DTO\Asset\Resolver\Input;

use Symfony\Component\Serializer\Serializer;

interface AssetValueResolverInterface
{
    public function getSerializer(): Serializer;
}
