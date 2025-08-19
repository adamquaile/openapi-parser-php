<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface MediaTypeObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): MediaTypeObjectMap;
}
