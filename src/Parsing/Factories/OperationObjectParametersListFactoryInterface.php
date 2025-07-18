<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OperationObjectParametersList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface OperationObjectParametersListFactoryInterface
{
    public function create(array $data, ParseContext $context): OperationObjectParametersList;
}
