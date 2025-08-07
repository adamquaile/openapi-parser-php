<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ResponseObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ResponseObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponseObjectMap;
}
