<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\PathItemObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface PathItemObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): PathItemObjectMap;
}
