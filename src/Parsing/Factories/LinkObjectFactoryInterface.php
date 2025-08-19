<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\LinkObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface LinkObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): LinkObject;
}
