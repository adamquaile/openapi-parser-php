<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\RequestBodyObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface RequestBodyObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): RequestBodyObject;
}
