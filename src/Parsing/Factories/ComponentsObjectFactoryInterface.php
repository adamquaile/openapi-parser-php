<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ComponentsObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface ComponentsObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ComponentsObject;
}
