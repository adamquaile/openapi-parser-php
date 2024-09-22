<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface MediaTypeObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): MediaTypeObjectMap;
}
