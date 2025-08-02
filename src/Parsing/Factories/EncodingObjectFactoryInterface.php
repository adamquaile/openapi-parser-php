<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\EncodingObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface EncodingObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): EncodingObject;
}
