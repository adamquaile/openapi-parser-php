<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\LinkObject;
use TypeSlow\OpenApiParser\Model\LinkObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface LinkObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): LinkObjectMap;
}
