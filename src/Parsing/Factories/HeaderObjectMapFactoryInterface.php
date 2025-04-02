<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface HeaderObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): HeaderObjectMap;
}
