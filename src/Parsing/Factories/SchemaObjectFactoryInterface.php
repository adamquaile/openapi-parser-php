<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\SchemaObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface SchemaObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): SchemaObject;
}
