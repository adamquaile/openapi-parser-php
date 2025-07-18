<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OperationObjectCallbacksMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface OperationObjectCallbacksMapFactoryInterface
{
    public function create(object $data, ParseContext $context): OperationObjectCallbacksMap;
}
