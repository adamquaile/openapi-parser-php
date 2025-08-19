<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface ExamplesMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ExamplesMap;
}
