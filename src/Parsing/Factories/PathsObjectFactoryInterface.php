<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\PathItemObject;
use Worq\OpenApiParser\Model\PathsObject;
use Worq\OpenApiParser\Model\ResponseObject;
use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface PathsObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): PathsObject;
}
