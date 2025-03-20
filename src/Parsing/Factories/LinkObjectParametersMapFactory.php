<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\LinkObjectParametersMap;
use TypeSlow\OpenApiParser\Model\RuntimeExpression;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class LinkObjectParametersMapFactory implements LinkObjectParametersMapFactoryInterface
{
    use MapFactoryTrait;
    public function create(object $data, ParseContext $context): LinkObjectParametersMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (string $item): RuntimeExpression|string => str_starts_with(haystack: $item, needle: '$')
                ? $context->factory->create(RuntimeExpression::class, $item, $context)
                : $item
        );
        return new LinkObjectParametersMap(
            items: $data
        );
    }
}
