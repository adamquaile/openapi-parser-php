<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\SchemasObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface SchemasObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): SchemasObject;
}
