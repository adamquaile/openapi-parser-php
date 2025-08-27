<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ParametersList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ParametersListFactoryInterface
{
    public function create(array $data, ParseContext $context): ParametersList;
}
