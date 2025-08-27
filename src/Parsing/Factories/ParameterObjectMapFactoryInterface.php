<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ParameterObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ParameterObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ParameterObjectMap;
}
