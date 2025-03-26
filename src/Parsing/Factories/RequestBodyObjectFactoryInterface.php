<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\RequestBodyObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface RequestBodyObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): RequestBodyObject;
}
