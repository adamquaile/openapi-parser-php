<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ResponseObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponseObject;
}
