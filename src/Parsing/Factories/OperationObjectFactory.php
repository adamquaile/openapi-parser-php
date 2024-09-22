<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\OperationObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class OperationObjectFactory
{
    public function create(object $data, ParseContext $context): OperationObject
    {
        return new OperationObject(
            operationId: $data->operationId ?? null,
        );
    }
}
