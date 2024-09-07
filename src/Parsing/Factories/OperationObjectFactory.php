<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Model\OperationObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class OperationObjectFactory
{
    public function create(array $data, ParseContext $context): OperationObject
    {
        return new OperationObject(
            operationId: $data['operationId'] ?? null,
        );
    }
}
