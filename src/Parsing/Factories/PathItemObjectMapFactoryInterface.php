<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\PathItemObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface PathItemObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): PathItemObjectMap;
}
