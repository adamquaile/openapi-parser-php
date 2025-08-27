<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ParameterObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ParameterObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ParameterObject;
}
