<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Model\OperationObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface OperationObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): OperationObject;
}
