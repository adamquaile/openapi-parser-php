<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\TagsList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface TagsListFactoryInterface
{
    public function create(array $data, ParseContext $context): TagsList;
}