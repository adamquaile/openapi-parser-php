<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface HeaderObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): HeaderObjectMap;
}
