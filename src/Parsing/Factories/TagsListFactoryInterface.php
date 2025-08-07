<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\TagsList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface TagsListFactoryInterface
{
    public function create(array $data, ParseContext $context): TagsList;
}