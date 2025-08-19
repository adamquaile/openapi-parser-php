<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ContactObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ContactObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ContactObject;
}
