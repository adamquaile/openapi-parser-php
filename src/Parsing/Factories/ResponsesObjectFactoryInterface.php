<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ResponsesObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponsesObject;
}
