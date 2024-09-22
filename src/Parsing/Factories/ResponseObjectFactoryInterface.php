<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ResponseObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponseObject;
}
