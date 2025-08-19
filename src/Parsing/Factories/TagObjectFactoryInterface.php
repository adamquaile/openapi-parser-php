<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\TagObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface TagObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): TagObject;
}
