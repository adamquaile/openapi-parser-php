<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface ResponsesObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): ResponsesObject;
}
