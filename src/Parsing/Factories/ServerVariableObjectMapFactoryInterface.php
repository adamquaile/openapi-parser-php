<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ServerVariableObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ServerVariableObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ServerVariableObjectMap;
}
