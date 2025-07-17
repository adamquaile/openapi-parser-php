<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\CallbackObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface CallbackObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): CallbackObject;
}
