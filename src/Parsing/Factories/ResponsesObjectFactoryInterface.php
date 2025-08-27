<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ResponsesObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponsesObject;
}
