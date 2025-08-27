<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ResponseObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ResponseObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponseObjectMap;
}
