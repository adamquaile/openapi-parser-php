<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\LinkObjectParametersMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface LinkObjectParametersMapFactoryInterface
{
    public function create(object $data, ParseContext $context): LinkObjectParametersMap;
}
