<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\PathItemObject;
use AdamQ\OpenApiParser\Model\PathsObject;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface PathItemObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): PathItemObject;
}
