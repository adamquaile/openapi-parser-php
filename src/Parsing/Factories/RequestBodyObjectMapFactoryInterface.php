<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\RequestBodyObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface RequestBodyObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): RequestBodyObjectMap;
}
