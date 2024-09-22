<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface InfoObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): InfoObject;
}
