<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\EncodingObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface EncodingObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): EncodingObjectMap;
}
