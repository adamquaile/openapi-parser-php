<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\OperationObject;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ServersListFactoryInterface
{
    public function create(array $data, ParseContext $context): ServersList;
}
