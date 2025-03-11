<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ReferenceObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ReferenceObject;
}
