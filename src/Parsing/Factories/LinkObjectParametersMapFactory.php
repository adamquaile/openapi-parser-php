<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\LinkObjectParametersMap;
use AdamQ\OpenApiParser\Model\RuntimeExpression;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
