<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ComponentsObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ComponentsObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ComponentsObject;
}
