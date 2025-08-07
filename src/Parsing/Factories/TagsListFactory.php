<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\TagObject;
use TypeSlow\OpenApiParser\Model\TagsList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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