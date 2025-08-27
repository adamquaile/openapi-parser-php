<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ExampleObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ExampleObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ExampleObjectMap;
}
