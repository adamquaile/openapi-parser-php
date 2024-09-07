<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ResponseObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface ResponseObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): ResponseObject;
}
