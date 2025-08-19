<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface MediaTypeObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): MediaTypeObject;
}
