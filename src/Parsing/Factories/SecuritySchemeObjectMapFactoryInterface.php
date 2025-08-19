<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\SecuritySchemeObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface SecuritySchemeObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): SecuritySchemeObjectMap;
}
