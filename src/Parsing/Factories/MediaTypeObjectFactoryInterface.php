<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MediaTypeObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface MediaTypeObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): MediaTypeObject;
}
