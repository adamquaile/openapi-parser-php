<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\DiscriminatorObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface DiscriminatorObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): DiscriminatorObject;
}
