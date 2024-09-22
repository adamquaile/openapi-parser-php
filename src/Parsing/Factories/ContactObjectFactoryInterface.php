<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ContactObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ContactObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ContactObject;
}
