<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface ResponsesObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponsesObject;
}
