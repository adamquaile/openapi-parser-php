<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface OpenApiObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): OpenApiObject;
}
