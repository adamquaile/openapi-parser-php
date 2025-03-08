<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\DiscriminatorObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface DiscriminatorObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): DiscriminatorObject;
}
