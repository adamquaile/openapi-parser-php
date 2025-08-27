<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\TagObject;
use AdamQ\OpenApiParser\Model\TagsList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class TagsListFactory implements TagsListFactoryInterface
{
    use ListFactoryTrait;

    public function create(array $data, ParseContext $context): TagsList
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $tag) => $context->factory->create(TagObject::class, $tag, $context)
        );
        return new TagsList(items: $data);
    }
}