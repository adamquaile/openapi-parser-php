<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\TagObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface TagObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): TagObject;
}
