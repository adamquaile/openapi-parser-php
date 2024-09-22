<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\PathItemObject;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface PathItemObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): PathItemObject;
}
