<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ServerObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ServerObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ServerObject;
}
