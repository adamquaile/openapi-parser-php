<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Model\OperationObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface OperationObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): OperationObject;
}
