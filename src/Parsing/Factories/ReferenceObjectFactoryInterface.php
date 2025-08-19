<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ReferenceObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ReferenceObject;
}
