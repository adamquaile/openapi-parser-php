<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OperationObject;
use TypeSlow\OpenApiParser\Model\ServersList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ServersListFactoryInterface
{
    public function create(array $data, ParseContext $context): ServersList;
}
