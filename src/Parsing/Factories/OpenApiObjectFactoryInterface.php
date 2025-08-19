<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface OpenApiObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): OpenApiObject;
}
