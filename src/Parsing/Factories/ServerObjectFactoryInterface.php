<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ServerObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ServerObject;
}
