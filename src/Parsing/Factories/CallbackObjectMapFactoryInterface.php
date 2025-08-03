<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\CallbackObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface CallbackObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): CallbackObjectMap;
}
