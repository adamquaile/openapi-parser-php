<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SchemasObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface SchemasObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): SchemasObject;
}
