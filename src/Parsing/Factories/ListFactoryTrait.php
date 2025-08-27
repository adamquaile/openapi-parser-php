<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

trait ListFactoryTrait
{
    protected static function modifyEveryObjectProperty(array &$items, callable $modifier): void
    {
        array_walk(
            $items,
            fn (&$property) => $property = $modifier($property),
        );
    }
}
